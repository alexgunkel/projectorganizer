<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 07.05.18
 * Time: 21:37
 */

namespace AlexGunkel\ProjectOrganizer\Controller;


use AlexGunkel\ProjectOrganizer\Domain\Model\Person;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ExpertController extends ActionController
{
    /**
     * @var \AlexGunkel\ProjectOrganizer\Domain\Repository\PersonRepository
     *
     * @inject
     */
    private $expertRepository;

    /**
     * List all experts
     */
    public function listAction(): void
    {
        $this->view->assign(
            'experts',
            $this->expertRepository->findAll()
        );
    }

    /**
     *
     */
    public function detailAction(): void
    {
        $this->view->assign(
            'expert',
            $this->expertRepository->findByIdentifier(
                $this->request->getArgument('uid')
            )
        );
    }

    public function insertFormAction(Person $person = null): void
    {
        $this->view->assign(
            'expert',
            $person ?? new Person
        );

        $this->view->assignMultiple($this->expertRepository->getPropertyOptions());
    }

    /**
     * @param Person $person
     */
    public function addAction(Person $person): void
    {
        $this->expertRepository->insert($person);
        $this->view->assign('expert', $person);
    }

}