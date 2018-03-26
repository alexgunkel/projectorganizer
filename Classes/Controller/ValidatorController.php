<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 13.08.17
 * Time: 14:29
 */

namespace AlexGunkel\ProjectOrganizer\Controller;


use AlexGunkel\ProjectOrganizer\Domain\Model\Project;
use AlexGunkel\ProjectOrganizer\Management\ManagableInterface;
use AlexGunkel\ProjectOrganizer\Service\ValidationServiceFactory;
use AlexGunkel\ProjectOrganizer\Value\Password;
use AlexGunkel\ProjectOrganizer\Value\ValidationStatus;
use TYPO3\CMS\Extbase\Mvc\Controller\Exception\RequiredArgumentMissingException;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class ValidatorController
    extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \AlexGunkel\ProjectOrganizer\Domain\Repository\ProjectRepository
     *
     * @inject
     */
    private $repository;

    /**
     * @var \AlexGunkel\ProjectOrganizer\AccessValidation\AccessValidatorInterface
     *
     * @inject
     */
    protected $accessValidator;

    /**
     * @var \AlexGunkel\ProjectOrganizer\AccessValidation\AcceptanceManagerInterface
     *
     * @inject
     */
    private $acceptanceManager;

    /**
     * Accept a single project
     *
     * @return void
     * @throws RequiredArgumentMissingException
     */
    public function validateAction() : void
    {
        if (!$this->request->hasArgument('project')) {
            throw new RequiredArgumentMissingException(
                'Argument \'project\' is required for this action',
                1496009921
            );
        }

        /** @var ManagableInterface $project */
        $project = $this->repository->findByUid(
            $this->request->getArgument('project')
        );

        $this->acceptanceManager->accept($project);
        $this->repository->update($project);

        $this->view->assign(
            'acceptedProject',
            $project
        );
    }

    public function validateByValidationCodeAction() : void
    {
        $code = new Password(
            $this->request->getArgument('validationCode')
        );

        /** @var Project $project */
        $project = $this->repository->findByUid(
            $this->request->getArgument('projectUid')
        );

        $passwordService = ValidationServiceFactory::buildPasswordService();
        if (!$passwordService->validateProject($project, $code)) {
            throw new \Exception('Password is not valid', 1522081006);
        }

        $project->setValidationState(new ValidationStatus(ValidationStatus::ACCEPTED));
        $this->repository->update($project);

        $this->view->assign('project', $project);
    }
}