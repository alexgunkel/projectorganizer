<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 13.08.17
 * Time: 10:18
 */

namespace AlexGunkel\ProjectOrganizer\Controller;

class DisplayController
    extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \AlexGunkel\ProjectOrganizer\Management\ManagableRepository
     *
     * @inject
     */
    private $entityRepository;

    final public function listAction() : void
    {
        $this->view->assignMultiple(
            [
                'entities' => $this->entityRepository->findAccepted(),
                'pluginName' => $this->request->getPluginName()
            ]
        );
    }

    final public function detailAction() : void
    {
        $this->view->assign(
            'entity',
            $this->entityRepository->findByUid(
                $this->request->getArgument('uid')
            )
        );
    }
}