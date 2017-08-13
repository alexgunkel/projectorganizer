<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 13.08.17
 * Time: 14:29
 */

namespace AlexGunkel\ProjectOrganizer\Controller;


use AlexGunkel\ProjectOrganizer\Management\ManagableInterface;

class ValidatorController
    extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \AlexGunkel\ProjectOrganizer\Management\ManagableRepository
     *
     * @inject
     */
    private $repository;

    /**
     * @var \AlexGunkel\ProjectOrganizer\Management\AccessValidation\AccessValidatorInterface
     *
     * @inject
     */
    protected $accessValidator;

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

        $project->getAcceptanceManager()
            ->setAccepted(new \DateTime())
            ->setAcceptedBy(
            $this->getBackendUser()->user['uid']
        );

        $this->repository->update($project);

        $this->view->assign(
            'acceptedProject',
            $project
        );
    }

    public function validateByValidationCodeAction() : void
    {
        $code = $this->request->getArgument('validationCode');
        $project = $this->repository->findByIdentifier(
            $this->request->getArgument('projectUid')
        );

        if (!$this->accessValidator->validate($project, $code)) {
            throw new \Exception('Not validated');
        }

        $project->setAccepted(new \DateTime());
        $this->repository->update($project);

        $this->view->assign('project', $project);
    }
}