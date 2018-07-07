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
use AlexGunkel\ProjectOrganizer\Service\Mail\ValidationCodeMessage;
use AlexGunkel\ProjectOrganizer\Service\MailServiceFactory;
use AlexGunkel\ProjectOrganizer\Service\ValidationServiceFactory;
use AlexGunkel\ProjectOrganizer\Traits\Repository\RegionRepositoryTrait;
use AlexGunkel\ProjectOrganizer\Traits\Repository\StatusRepositoryTrait;
use AlexGunkel\ProjectOrganizer\Traits\Repository\TopicRepositoryTrait;
use AlexGunkel\ProjectOrganizer\Traits\Repository\WskelementRepositoryTrait;
use AlexGunkel\ProjectOrganizer\Value\Password;
use TYPO3\CMS\Extbase\Mvc\View\EmptyView;
use TYPO3\CMS\Extbase\Mvc\View\JsonView;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use AlexGunkel\ProjectOrganizer\Traits\FlexformTrait;
use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;

class EditorController
    extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    use StatusRepositoryTrait,
        TopicRepositoryTrait,
        RegionRepositoryTrait,
        WskelementRepositoryTrait,
        FlexformTrait,
        CsvTrait,
        UserTrait;

    /**
     * @var \AlexGunkel\ProjectOrganizer\Domain\Repository\ProjectRepository
     *
     * @inject
     */
    private $projectRepository;

    /**
     * @var \AlexGunkel\ProjectOrganizer\AccessValidation\AcceptanceManager
     *
     * @inject
     */
    private $acceptanceManager;

    /**
     *
     */
    final public function listAction()
    {
        $projects = $this->projectRepository->findAccepted();
        $this->view->assignMultiple(
            [
                'user' => $this->getUserAuthentication()->user,
                'projects' => $projects,
                'pluginName' => $this->request->getPluginName(),
                'detailViewPage' => $this->readAsInteger('detail_view_page') ?? $GLOBALS['TSFE']->id,
            ]
        );

        if (isset($_GET['csv'])) {
            $this->sendCsv($projects->toArray());
        }
    }

    /**
     *
     */
    final public function listByTopicAction(): void
    {
        $this->view->assignMultiple(
            [
                'user' => $this->getUserAuthentication()->user,
                'projects' => $projects = $this->projectRepository->findAcceptedByTopicUid($this->request->getArgument('topic')),
                'pluginName' => $this->request->getPluginName(),
            ]
        );

        if (isset($_GET['csv'])) {
            $this->sendCsv($projects->toArray());
        }
    }

    /**
     * @param ManagableInterface|null $project
     */
    public function createAction(Project $project = null) : void
    {
        $this->view->assignMultiple(
                array_merge(
                    $this->projectRepository->getPropertyOptions(),
                    [
                        'insertInstitutionPage' => $this->readAsInteger('insert_institution_page') ?? $GLOBALS['TSFE']->id,
                        'pluginName' => $this->request->getPluginName(),
                        'project' => $project,
                    ]
                    )
            );
    }

    /**
     * @param ManagableInterface|null $project
     */
    public function editAction(Project $project = null) : void
    {
        if (null == $project) {
            $project = $this->projectRepository->findByIdentifier(
                $this->request->getArgument('uid')
            );
        }

        $this->view->assignMultiple(
            array_merge(
                $this->projectRepository->getPropertyOptions(),
                [
                    'insertInstitutionPage' => $this->readAsInteger('insert_institution_page') ?? $GLOBALS['TSFE']->id,
                    'pluginName' => $this->request->getPluginName(),
                    'oldProject' => $project->getUid(),
                    'project' => $project->copy()->setOrig($project),
                ]
            )
        );
    }

    /**
     *
     */
    final public function detailAction() : void
    {
        $this->view->assignMultiple(
            [
                'user' => $this->getUserAuthentication()->user,
                'project' => $project = $this->projectRepository->findByUid($this->request->getArgument('uid')),
                'listViewPage' => $this->readAsInteger('list_view_page') ?? $GLOBALS['TSFE']->id,
            ]
        );

        if (isset($_GET['csv'])) {
            $this->sendCsv([$project]);
        }
    }

    /**
     * @param Project $project
     */
    public function persistAction(Project $project): void
    {
        $oldProject = $this->request->getArgument('oldProject');
        $parent = $this->projectRepository->findByIdentifier($oldProject);
        $this->registerNewProject($project->setOrig($parent));

        $this->forward('detail', null, null, ['uid' => $oldProject]);
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
        list($message, $response) = $this->registerNewProject($project);

        $this->view->assign('projectTitle', $project->getTitle());
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

        /** @var Project $project */
        $project = $this->projectRepository->findByUid(
            $this->request->getArgument('itemUid')
        );

        if ($this->request->hasArgument('do_it')) {
            $passwordService = ValidationServiceFactory::buildPasswordService();
            if (!$passwordService->validateProject($project, $code)) {
                throw new \Exception('Password is not valid', 1522081006);
            }

            $this->acceptanceManager->accept($project);
            $this->projectRepository->update($project);

            if (null !== $project->getOrig()) {
                $this->projectRepository->remove($project->getOrig());
            }
        } else {
            $this->view->assign('validationCode', $code);
            $this->view->assign('itemUid', $project->getUid());
        }

        $this->view->assign('project', $project);
    }

    /**
     * @param Project $project
     * @return array
     */
    private function registerNewProject(Project $project): array
    {
        $this->acceptanceManager->initializeAsNotYetAccepted($project);
        $passwordService = ValidationServiceFactory::buildPasswordService();
        $project->setPassword($passwordService->generateRandomPassword());
        $project->setPasswordHash($passwordService->getSaltedPassword($project->getPassword()));

        $this->projectRepository->add($project);

        /** @var PersistenceManager $persistenceManager */
        $persistenceManager = $this->objectManager->get(PersistenceManager::class);
        $persistenceManager->persistAll();

        $message = MailServiceFactory::buildValidationCodeMessage(
            $project, $this->uriBuilder, null, null, 'Editor'
        );
        $deliveryAgent = MailServiceFactory::buildDeliveryAgent($this->settings['receiver']);
        $response = $deliveryAgent->sendMessage($message);
        return array($message, $response);
    }
}