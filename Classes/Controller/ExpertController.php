<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 07.05.18
 * Time: 21:37
 */

namespace AlexGunkel\ProjectOrganizer\Controller;


use AlexGunkel\ProjectOrganizer\Domain\Model\Person;
use AlexGunkel\ProjectOrganizer\Service\MailServiceFactory;
use AlexGunkel\ProjectOrganizer\Service\ValidationServiceFactory;
use AlexGunkel\ProjectOrganizer\Value\Password;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

class ExpertController extends ActionController
{
    /**
     * @var \AlexGunkel\ProjectOrganizer\Domain\Repository\PersonRepository
     *
     * @inject
     */
    private $expertRepository;

    /**
     * @var \AlexGunkel\ProjectOrganizer\AccessValidation\PasswordHashValidator
     *
     * @inject
     */
    protected $accessValidator;

    /**
     * @var \AlexGunkel\ProjectOrganizer\AccessValidation\AcceptanceManager
     *
     * @inject
     */
    private $acceptanceManager;

    /**
     * List all experts
     */
    public function listAction(): void
    {
        $this->view->assign(
            'experts',
            $this->expertRepository->findAccepted(true)
        );
    }

    /**
     *
     */
    public function detailAction(): void
    {
        /** @var Person $expert */
        $expert = $this->expertRepository->findByIdentifier(
            $this->request->getArgument('uid')
        );

        if ($expert->getInstitution()) {
            $this->view->assign(
                'otherExperts', $this->expertRepository->findByInstitution($expert->getInstitution() )
            );
        }

        $this->view->assign(
            'expert',
            $expert
        );
    }

    public function insertFormAction(Person $person = null): void
    {
        $this->view->assign(
            'expert',
            $person ?? new Person
        );

        $this->view->assignMultiple($this->expertRepository->getPropertyOptions());
    }

    /**
     * @param Person $person
     *
     * @return void
     */
    public function submitAction(Person $person) : void
    {
        list($message, $response) = $this->registerNewPerson($person);

        $this->view->assign('personTitle', $person->getTitle());
        $this->view->assign('success', $response);
        $this->view->assign('message', $message);
    }

    /**
     * @throws \Exception
     */
    public function validateByValidationCodeAction() : void
    {
        $code = new Password(
            $this->request->getArgument('validationCode')
        );

        /** @var Person $expert */
        $expert = $this->expertRepository->findByUid(
            $this->request->getArgument('itemUid')
        );

        $passwordService = ValidationServiceFactory::buildPasswordService();
        if (!$passwordService->validateProject($expert, $code)) {
            throw new \Exception('Password is not valid', 1522081006);
        }

        $this->acceptanceManager->accept($expert);
        $this->expertRepository->update($expert);

        $this->view->assign('expert', $expert);
    }

    /**
     * @param Person $person
     * @return array
     */
    private function registerNewPerson(Person $person): array
    {
        $person->setValidationState(Person::VALIDATION_STATE_OPEN);
        $passwordService = ValidationServiceFactory::buildPasswordService();
        $person->setPassword($passwordService->generateRandomPassword());
        $person->setPasswordHash($passwordService->getSaltedPassword($person->getPassword()));

        $this->expertRepository->add($person);

        /** @var PersistenceManager $persistenceManager */
        $persistenceManager = $this->objectManager->get(PersistenceManager::class);
        $persistenceManager->persistAll();

        $message = MailServiceFactory::buildValidationCodeMessage(
            $person,
            $this->uriBuilder,
            null,
            null,
            'Expert'
        );
        $deliveryAgent = MailServiceFactory::buildDeliveryAgent($this->settings['receiver']);
        $response = $deliveryAgent->sendMessage($message);
        return array($message, $response);
    }
}