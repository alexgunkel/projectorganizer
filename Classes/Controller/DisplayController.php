<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 13.08.17
 * Time: 10:18
 */

namespace AlexGunkel\ProjectOrganizer\Controller;


use AlexGunkel\ProjectOrganizer\Management\ManagableInterface;
use AlexGunkel\ProjectOrganizer\Management\DisplayControllerInterface;
use AlexGunkel\ProjectOrganizer\Management\ManagableRepository;

class DisplayController
    extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
    implements DisplayControllerInterface
{
    /**
     * @var \AlexGunkel\ProjectOrganizer\Management\ManagableRepository
     *
     * @inject
     */
    private $entityRepository;

    final public function listAction() : void
    {
        $this->view->assign(
            'entities',
            $this->entityRepository->findAccepted()
        );
    }

    final public function detailAction() : void
    {
        /** @var ManagableInterface $entity */
        $entity = $this->entityRepository->findByUid(
            $this->request->getArgument('uid')
        );

        $this->view->assign(
            'entity',
            $entity
        );
    }
}