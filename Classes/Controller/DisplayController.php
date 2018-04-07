<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 13.08.17
 * Time: 10:18
 */

namespace AlexGunkel\ProjectOrganizer\Controller;

use AlexGunkel\ProjectOrganizer\Traits\FlexformTrait;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class DisplayController
    extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    use FlexformTrait;

    /**
     * @var \AlexGunkel\ProjectOrganizer\Domain\Repository\ProjectRepository
     *
     * @inject
     */
    private $entityRepository;

    /**
     * @var \AlexGunkel\ProjectOrganizer\Domain\Repository\TopicRepository
     *
     * @inject
     */
    private $topicRepository;

    final public function listAction() : void
    {
        $this->view->assignMultiple(
            [
                'entities' => $this->entityRepository->findAccepted(),
                'pluginName' => $this->request->getPluginName(),
                'detailViewPage' => $this->readAsInteger('detail_view_page') ?? $GLOBALS['TSFE']->id,
            ]
        );
    }

    final public function listByTopicsAction(): void
    {
        $this->view->assignMultiple(
            [
                'entities' => $this->topicRepository->findAll(),
                'pluginName' => $this->request->getPluginName(),
            ]
        );
    }

    final public function detailAction() : void
    {
        $this->view->assignMultiple(
            [
                'project' => $this->entityRepository->findByUid($this->request->getArgument('uid')),
                'listViewPage' => $this->readAsInteger('list_view_page') ?? $GLOBALS['TSFE']->id,
            ]
        );
    }
}