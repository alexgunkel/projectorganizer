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
use AlexGunkel\ProjectOrganizer\Service\Mail\DeliveryAgentInterface;
use AlexGunkel\ProjectOrganizer\Service\Mail\ValidationCodeMessageInterface;
use AlexGunkel\ProjectOrganizer\Traits\Repository\ProjectRepositoryTrait;
use AlexGunkel\ProjectOrganizer\Traits\Repository\RegionRepositoryTrait;
use AlexGunkel\ProjectOrganizer\Traits\Repository\StatusRepositoryTrait;
use AlexGunkel\ProjectOrganizer\Traits\Repository\TopicRepositoryTrait;
use AlexGunkel\ProjectOrganizer\Traits\Repository\WskelementRepositoryTrait;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class ProjectEditorController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    use ProjectRepositoryTrait,
        StatusRepositoryTrait,
        TopicRepositoryTrait,
        RegionRepositoryTrait,
        WskelementRepositoryTrait;

    /**
     * @param Project|null $project
     */
    public function createAction(Project $project = null) : void
    {
        $this->view
            ->assignMultiple(
                array(
                    'project'       => $project,
                    'topics'        => $this->topicRepository->findAll(),
                    'statusOptions' => $this->statusRepository->findAll(),
                    'regions'       => $this->regionRepository->findAll(),
                    'wskelements'   => $this->wskelementRepository->findAll(),
                )
            );
    }

    /**
     * Add the given project and return project to view
     *
     * @param Project $project
     *
     * @return void
     */
    public function submitAction(Project $project) : void
    {
        $project->initializeAsNotYetAccepted();
        $this->projectRepository->add($project);
        /** @var PersistenceManager $persistenceManager */
        $this->objectManager->get(PersistenceManager::class)->persistAll();
        /** @var ValidationCodeMessageInterface $message */
        $message = $this->objectManager->get(ValidationCodeMessageInterface::class);
        /** @var DeliveryAgentInterface $deliveryAgent */
        $deliveryAgent = $this->objectManager->get(DeliveryAgentInterface::class);

        $message->setObject($project);
        $success = $deliveryAgent->addRecipient($this->settings['receiver'])
            ->sendMessage($message);

        $this->view->assign('projectTitle', $project->getTitle());
        $this->view->assign('success', $success);
        $this->view->assign('message', $message);
    }
}