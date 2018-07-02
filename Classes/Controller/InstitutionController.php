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
            $this->institutionRepository->findAll()
            );

        $this->view->assign(
            'pluginName',
            $this->request->getPluginName()
        );
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
            $this->view->assign('itemUid', $project->getUid());
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
            'Institution'
        );
        $deliveryAgent = MailServiceFactory::buildDeliveryAgent($this->settings['receiver']);
        $response = $deliveryAgent->sendMessage($message);
        return array($message, $response);
    }
}

