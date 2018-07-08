<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 07.05.18
 * Time: 21:37
 */

namespace AlexGunkel\ProjectOrganizer\Controller;


use AlexGunkel\ProjectOrganizer\Domain\Model\Person;
use AlexGunkel\ProjectOrganizer\Domain\Model\Publication;
use AlexGunkel\ProjectOrganizer\Domain\Model\Wskelement;
use AlexGunkel\ProjectOrganizer\Domain\Repository\PublicationRepository;
use AlexGunkel\ProjectOrganizer\Service\MailServiceFactory;
use AlexGunkel\ProjectOrganizer\Service\ValidationServiceFactory;
use AlexGunkel\ProjectOrganizer\Value\Password;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

class ExpertController extends ActionController
{
    use CsvTrait,
        UserTrait;

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
     * @var \AlexGunkel\ProjectOrganizer\Domain\Repository\PublicationRepository
     *
     * @inject
     */
    private $publicationRepository;

    /**
     * List all experts
     */
    public function listAction(): void
    {
        $this->view->assign(
            'experts',
            $experts = $this->expertRepository->findAccepted(true)
        );
        $this->view->assign(
            'user',
            $this->getUserAuthentication()->user
        );
        $this->view->assign(
            'be_user',
            $this->getBeUserAuthentication()
        );

        if ($this->request->hasArgument('csv')) {
            $this->sendCsv($experts->toArray());
        }
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
                'otherExperts', $this->expertRepository->findOthersByInstitution($expert->getInstitution(), $expert)
            );
        }

        $otherWsk = [];
        /** @var Wskelement $wskelement */
        foreach ($expert->getWskelements() as $wskelement) {
            $otherWsk[$wskelement->getTitle()] = $this->expertRepository->findOthersByWsk($wskelement, $expert);
        }

        $this->view->assign('otherWsk', $otherWsk);

        $this->view->assign(
            'expert',
            $expert
        );
        $this->view->assign(
            'user',
            $this->getUserAuthentication()->user
        );
        $this->view->assign(
            'be_user',
            $this->getBeUserAuthentication()
        );
    }

    public function deleteAction(): void
    {
        $object = $this->expertRepository->findByIdentifier(
            $this->request->getArgument('uid')
        );

        $this->expertRepository->remove($object);
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
        $arguments = $this->request->getArguments();

        for ($i = 0; $i < 10; $i++) {
            if (!isset($arguments['publication' . $i]) || empty($arguments['publication' . $i])) {
                break;
            }

            $publication = new Publication;
            $publication->setTitle($arguments['publication' . $i]);
            $publication->setAuthor($arguments['publication' . $i] ?? '');
            $publication->setType($arguments['type' . $i] ?? '');
            $publication->setPublished($arguments['year' . $i] ?? '');
            $this->publicationRepository->insert($publication);
            $person->addPublication($publication);
        }

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

        if ($this->request->hasArgument('do_it')) {
            $passwordService = ValidationServiceFactory::buildPasswordService();
            if (!$passwordService->validateProject($expert, $code)) {
                throw new \Exception('Password is not valid', 1522081006);
            }

            $this->acceptanceManager->accept($expert);
            $this->expertRepository->update($expert);
        } else {
            $this->view->assign('validationCode', $code);
            $this->view->assign('itemUid', $project->getUid());
        }

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