<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 13.08.17
 * Time: 14:29
 */

namespace AlexGunkel\ProjectOrganizer\Controller;

use AlexGunkel\ProjectOrganizer\Domain\Model\Project;
use AlexGunkel\ProjectOrganizer\Service\ValidationServiceFactory;
use AlexGunkel\ProjectOrganizer\Value\Password;

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
     * @var \AlexGunkel\ProjectOrganizer\AccessValidation\AcceptanceManager
     *
     * @inject
     */
    private $acceptanceManager;

    /**
     * @throws \Exception
     */
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

        $this->acceptanceManager->accept($project);
        $this->repository->update($project);

        $this->view->assign('project', $project);
    }
}
