<?php
/**
 * This file is part of ProjectOrganizer.
 *
 * ProjectOrganizer is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ProjectOrganizer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ProjectOrganizer.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category TYPO3 Extension
 * @package  Project Organizer
 * @author   Alexander Gunkel <alexandergunkel@gmail.com>
 * @license  GPL
 * @link     http://www.gnu.org/licenses/
 */

namespace AlexGunkel\ProjectOrganizer\Controller;

use AlexGunkel\ProjectOrganizer\Domain\Model\Project;
use AlexGunkel\ProjectOrganizer\Management\ManagerControllerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\Exception\RequiredArgumentMissingException;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class ManagerController
    extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
    implements ManagerControllerInterface
{
    /**
     * @var \AlexGunkel\ProjectOrganizer\Management\ManagableRepository
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
     * List all open requests
     *
     * @return void
     */
    public function listOpenRequestsAction() : void
    {
        $this->view->assign(
            'projects',
            $this->repository->findOpenRequests()
        );
    }

    /**
     * Show details of a project that is given by its uid
     *
     * @return void
     */
    public function detailAction() : void
    {
        /** @var Project $project */
        $project = $this->repository->findByUid(
            $this->request->getArgument('project')
        );

        $this->view->assign(
            'project',
            $project
        );
    }

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

        /** @var Project $project */
        $project = $this->repository->findByUid(
            $this->request->getArgument('project')
        );

        $this->acceptanceManager->accept(
            $project
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

        $this->acceptanceManager->setAccepted($project, new \DateTime());
        $this->repository->update($project);

        $this->view->assign('project', $project);
    }
}
?>
