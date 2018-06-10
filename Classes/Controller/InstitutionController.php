<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 14.04.18
 * Time: 10:41
 */

namespace AlexGunkel\ProjectOrganizer\Controller;

use AlexGunkel\ProjectOrganizer\Domain\Model\Institution;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Class InstitutionController
 * @package AlexGunkel\ProjectOrganizer\Controller
 */
class InstitutionController extends ActionController
{
    /**
     * @var \AlexGunkel\ProjectOrganizer\Domain\Repository\InstitutionRepository
     * 
     * @inject
     */
    private $institutionRepository;

    /**
     * List all Organisations
     */
    public function listAction(): void
    {
        $this->view->assign(
            'institutions',
            $this->institutionRepository->findAll()
            );

        $this->view->assign(
            'pluginName',
            $this->request->getPluginName()
        );
    }

    /**
     *
     */
    public function detailAction(): void
    {
        $this->view->assign(
            'institution',
            $this->institutionRepository->findByIdentifier(
                $this->request->getArgument('uid')
            )
        );
    }

    public function insertFormAction(Institution $institution = null): void
    {
        $this->view->assign(
            'institution',
            $institution ?? new Institution
        );

        $this->view->assignMultiple($this->institutionRepository->getPropertyOptions());
    }

    public function addAction(Institution $institution): void
    {
        $this->institutionRepository->insert($institution);
        $this->view->assign('institution', $institution);
    }
}

