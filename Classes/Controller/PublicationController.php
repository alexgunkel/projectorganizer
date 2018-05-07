<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 14.04.18
 * Time: 10:41
 */

namespace AlexGunkel\ProjectOrganizer\Controller;

use AlexGunkel\ProjectOrganizer\Domain\Model\Publication;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Class PublicationController
 * @package AlexGunkel\ProjectOrganizer\Controller
 */
class PublicationController extends ActionController
{
    /**
     * @var \AlexGunkel\ProjectOrganizer\Domain\Repository\PublicationRepository
     *
     * @inject
     */
    private $publicationRepository;

    /**
     * List all Organisations
     */
    public function listAction(): void
    {
        $this->view->assign(
            'publications',
            $this->publicationRepository->findAll()
        );
    }

    /**
     *
     */
    public function detailAction(): void
    {
        $this->view->assign(
            'publication',
            $this->publicationRepository->findByIdentifier(
                $this->request->getArgument('uid')
            )
        );
    }

    public function insertFormAction(Publication $publication = null): void
    {
        $this->view->assign(
            'publication',
            $publication ?? new Publication
        );
    }

    public function addAction(Publication $publication): void
    {
        $this->publicationRepository->insert($publication);
        $this->view->assign('publication', $publication);
    }
}

