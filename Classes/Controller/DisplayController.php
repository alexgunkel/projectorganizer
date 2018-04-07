<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 13.08.17
 * Time: 10:18
 */

namespace AlexGunkel\ProjectOrganizer\Controller;

use AlexGunkel\ProjectOrganizer\Traits\FlexformTrait;

/**
 * Class DisplayController
 * @package AlexGunkel\ProjectOrganizer\Controller
 */
class DisplayController
    extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    use FlexformTrait;

    /**
     * @var \AlexGunkel\ProjectOrganizer\Domain\Repository\ProjectRepository
     *
     * @inject
     */
    private $projectRepository;

    /**
     *
     */
    final public function listAction() : void
    {
        $this->view->assignMultiple(
            [
                'projects' => $this->projectRepository->findAccepted(),
                'pluginName' => $this->request->getPluginName(),
                'detailViewPage' => $this->readAsInteger('detail_view_page') ?? $GLOBALS['TSFE']->id,
            ]
        );
    }

    /**
     *
     */
    final public function listByTopicAction(): void
    {
        $this->view->assignMultiple(
            [
                'projects' => $this->projectRepository->findAcceptedByTopicUid($this->request->getArgument('topic')),
                'pluginName' => $this->request->getPluginName(),
            ]
        );
    }

    /**
     *
     */
    final public function detailAction() : void
    {
        $this->view->assignMultiple(
            [
                'project' => $this->projectRepository->findByUid($this->request->getArgument('uid')),
                'listViewPage' => $this->readAsInteger('list_view_page') ?? $GLOBALS['TSFE']->id,
            ]
        );
    }
}