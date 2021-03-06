<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 14.04.18
 * Time: 10:41
 */

namespace AlexGunkel\ProjectOrganizer\Controller;

use AlexGunkel\ProjectOrganizer\Domain\Model\Institution;
use AlexGunkel\ProjectOrganizer\Service\MailServiceFactory;
use AlexGunkel\ProjectOrganizer\Service\ValidationServiceFactory;
use AlexGunkel\ProjectOrganizer\Value\Password;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

/**
 * Class InstitutionController
 * @package AlexGunkel\ProjectOrganizer\Controller
 */
class InstitutionController extends ActionController
{
    use CsvTrait,
        UserTrait;

    /**
     * @var \AlexGunkel\ProjectOrganizer\Domain\Repository\InstitutionRepository
     * 
     * @inject
     */
    private $institutionRepository;

    /**
     * @var \AlexGunkel\ProjectOrganizer\AccessValidation\AcceptanceManager
     *
     * @inject
     */
    private $acceptanceManager;

    /**
     * List all Organisations
     */
    public function listAction(): void
    {
        $this->view->assign(
            'institutions',
            $institutions = $this->institutionRepository->findAll()
            );

        if ($this->request->hasArgument('csv')) {
            $this->sendCsv($institutions->toArray());
        }

        $this->view->assign(
            'pluginName',
            $this->request->getPluginName()
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
        $object = $this->institutionRepository->findByIdentifier(
            $this->request->getArgument('uid')
        );

        $this->institutionRepository->remove($object);
    }

    /**
     *
     */
    public function detailAction(): void
    {
        $this->view->assign(
            'institution',
            $this->institutionRepository->findByIdentifier(
                $this->request->getArgument('uid')
            )
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

    public function insertFormAction(Institution $institution = null): void
    {
        $this->view->assign(
            'institution',
            $institution ?? new Institution
        );

        $this->view->assignMultiple($this->institutionRepository->getPropertyOptions());
    }

    public function addAction(Institution $institution): void
    {
        $this->institutionRepository->insert($institution);
        list($message, $response) = $this->registerNew($institution);

        $this->view->assign('institution', $institution);
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

        /** @var Institution $institution */
        $institution = $this->institutionRepository->findByUid(
            $this->request->getArgument('itemUid')
        );

        if ($this->request->hasArgument('do_it')) {
            $passwordService = ValidationServiceFactory::buildPasswordService();
            if (!$passwordService->validateProject($institution, $code)) {
                throw new \Exception('Password is not valid', 1522081006);
            }

            $this->acceptanceManager->accept($institution);
            $this->institutionRepository->update($institution);
        } else {
            $this->view->assign('validationCode', $code);
            $this->view->assign('itemUid', $institution->getUid());
        }

        $this->view->assign('institution', $institution);
    }

    /**
     * @param Person $institution
     * @return array
     */
    private function registerNew(Institution $institution): array
    {
        $institution->setValidationState(Institution::VALIDATION_STATE_OPEN);
        $passwordService = ValidationServiceFactory::buildPasswordService();
        $institution->setPassword($passwordService->generateRandomPassword());
        $institution->setPasswordHash($passwordService->getSaltedPassword($institution->getPassword()));

        $this->institutionRepository->add($institution);

        /** @var PersistenceManager $persistenceManager */
        $persistenceManager = $this->objectManager->get(PersistenceManager::class);
        $persistenceManager->persistAll();

        $message = MailServiceFactory::buildValidationCodeMessage(
            $institution,
            $this->uriBuilder,
            null,
            null,
            'Institution',
            \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:project_organizer/Resources/Private/Email/Institution.phtml')

        );
        $deliveryAgent = MailServiceFactory::buildDeliveryAgent($this->settings['receiver']);
        $response = $deliveryAgent->sendMessage($message);
        return array($message, $response);
    }
}

