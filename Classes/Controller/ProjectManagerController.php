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
use AlexGunkel\ProjectOrganizer\Traits\Inject\AccessValidatorTrait;
use AlexGunkel\ProjectOrganizer\Traits\Repository\ProjectRepositoryTrait;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Extbase\Mvc\Controller\Exception\RequiredArgumentMissingException;

class ProjectManagerController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    use ProjectRepositoryTrait,
        AccessValidatorTrait;

    /**
     * List all open requests
     *
     * @return void
     */
    public function listOpenRequestsAction()
    {
        $this->view->assign(
            'projects',
            $this->projectRepository->findOpenRequests()
        );
    }

    /**
     * Show details of a project that is given by its uid
     *
     * @return void
     */
    public function detailAction()
    {
        /** @var Project $project */
        $project = $this->projectRepository->findByUid(
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
    public function validateAction()
    {
        if (!$this->request->hasArgument('project')) {
            throw new RequiredArgumentMissingException(
                'Argument \'project\' is required for this action',
                1496009921
            );
        }

        /** @var Project $project */
        $project = $this->projectRepository->findByUid(
            $this->request->getArgument('project')
        );

        $project->setAccepted(time());
        $project->setAcceptedBy(
            $this->getBackendUser()->user['uid']
        );

        $this->projectRepository->update($project);

        $this->view->assign(
            'acceptedProject',
            $project
        );
    }

    public function validateByValidationCodeAction() : void
    {
        $code = $this->request->getArgument('validationCode');
        $project = $this->projectRepository->findByIdentifier(
            $this->request->getArgument('projectUid')
        );

        if (!$this->accessValidator->validate($project, $code)) {
            throw new \Exception('Not validated');
        }

        $project->setAccepted(time());
        $this->projectRepository->update($project);

        $this->view->assign('project', $project);
    }

    /**
     * Returns the backend user
     *
     * @return BackendUserAuthentication
     */
    private function getBackendUser() : BackendUserAuthentication
    {
        global $BE_USER;

        return $BE_USER;
    }
}
?>
