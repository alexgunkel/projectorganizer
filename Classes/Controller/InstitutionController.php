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
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use phpDocumentor\Reflection\Types\Null_;

/**
 * Class InstitutionController
 * @package AlexGunkel\ProjectOrganizer\Controller
 */
class InstitutionController extends ActionController
{
    /**
     * @var \AlexGunkel\ProjectOrganizer\Domain\Repository\InstitutionRepository
     */
    private $institutionRepository;

    /**
     * List all Organisations
     */
    public function listAction(): void
    {
        $this->view->assign('institutions', $this->institutionRepository->findAll());
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
    }

    public function addInstitution(Institution $institution): void
    {
        $this->institutionRepository->add($institution);
        
        /** @var PersistenceManager $persistenceManager */
        $persistenceManager = $this->objectManager->get(PersistenceManager::class);
        $persistenceManager->persistAll();
    }
}

