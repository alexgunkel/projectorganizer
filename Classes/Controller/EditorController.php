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

use AlexGunkel\ProjectOrganizer\AccessValidation\AcceptableInterface;
use AlexGunkel\ProjectOrganizer\Management\EditorControllerInterface;
use AlexGunkel\ProjectOrganizer\Management\ManagableInterface;
use AlexGunkel\ProjectOrganizer\Service\Mail\DeliveryAgentInterface;
use AlexGunkel\ProjectOrganizer\Service\Mail\ValidationCodeMessageInterface;
use AlexGunkel\ProjectOrganizer\Traits\Repository\RegionRepositoryTrait;
use AlexGunkel\ProjectOrganizer\Traits\Repository\StatusRepositoryTrait;
use AlexGunkel\ProjectOrganizer\Traits\Repository\TopicRepositoryTrait;
use AlexGunkel\ProjectOrganizer\Traits\Repository\WskelementRepositoryTrait;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

class EditorController
    extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
    implements EditorControllerInterface
{
    use StatusRepositoryTrait,
        TopicRepositoryTrait,
        RegionRepositoryTrait,
        WskelementRepositoryTrait;

    /**
     * @var \AlexGunkel\ProjectOrganizer\Management\EditableRepositoryInterface
     *
     * @inject
     */
    private $projectRepository;

    /**
     * @var \AlexGunkel\ProjectOrganizer\AccessValidation\AcceptanceManagerInterface
     *
     * @inject
     */
    private $acceptanceManager;

    /**
     * @param ManagableInterface|null $project
     */
    public function createAction(AcceptableInterface $project = null) : void
    {
        $this->view
            ->assign('project', $project)
            ->assign('pluginName', $this->request->getPluginName())
            ->assignMultiple(
                $this->projectRepository->getPropertyOptions()
            );
    }

    /**
     * Add the given project and return project to view
     *
     * @param ManagableInterface $project
     *
     * @return void
     */
    public function submitAction(AcceptableInterface $project) : void
    {
        $this->acceptanceManager->initializeAsNotYetAccepted($project);
        $this->projectRepository->add($project);
        /** @var PersistenceManager $persistenceManager */
        $this->objectManager->get(PersistenceManager::class)->persistAll();

        /** @var ValidationCodeMessageInterface $message */
        $message = $this->objectManager->get(ValidationCodeMessageInterface::class);
        $message->setObject($project)
            ->setUriBuilder($this->uriBuilder);

        /** @var DeliveryAgentInterface $deliveryAgent */
        $deliveryAgent = $this->objectManager->get(DeliveryAgentInterface::class);

        $success = $deliveryAgent->addRecipient($this->settings['receiver'])
            ->sendMessage($message);

        $this->view->assign('projectTitle', $project->getTitle());
        $this->view->assign('success', $success);
        $this->view->assign('message', $message);
    }
}