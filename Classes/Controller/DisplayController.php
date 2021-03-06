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
        $projects = $this->projectRepository->findAccepted();
        $this->view->assignMultiple(
            [
                'projects' => $projects,
                'pluginName' => $this->request->getPluginName(),
                'detailViewPage' => $this->readAsInteger('detail_view_page') ?? $GLOBALS['TSFE']->id,
                'addNewProjectPage' => $this->readAsInteger('add_new_project_page') ?? $GLOBALS['TSFE']->id,
            ]
        );

        if ($this->request->hasArgument('csv')) {
            $list = [];
            foreach ($projects as $project) {
                $array = [];
                $methods = get_class_methods($projects);
                foreach ($methods as $method) {
                    if ('get' === substr($method, 0, 3)) {
                        $array[] = $project->$method();
                    }
                }
                $list[] = implode(',', $array);
            }

            return implode(PHP_EOL, implode($list));
        }
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

    final public function listByAction(): void
    {
        $possibleKeys = [
            'topic',
            'institution',
            'wsk',
        ];

        $filter = array_intersect_key(
            $this->request->getArguments(),
            array_flip($possibleKeys)
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
                'addNewProjectPage' => $this->readAsInteger('add_new_project_page') ?? $GLOBALS['TSFE']->id,
            ]
        );
    }
}