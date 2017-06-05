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
use AlexGunkel\ProjectOrganizer\Traits\Repository\ProjectRepositoryTrait;

class ProjectController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    use ProjectRepositoryTrait;

    /**
     * List action
     *
     * @return void
     */
    public function listAction() : void
    {
        $this->view->assign(
            'projects',
            $this->projectRepository->findAccepted()
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
        $project = $this->projectRepository->findByUid(
            $this->request->getArgument('project')
        );
        assert(true === $project->isAccepted());

        $this->view->assign(
            'project',
            $project
        );
    }
}

?>
