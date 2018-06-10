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

namespace AlexGunkel\ProjectOrganizer\Domain\Repository;

use AlexGunkel\ProjectOrganizer\Domain\Model\Project;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use AlexGunkel\ProjectOrganizer\Domain\Model\Institution;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use AlexGunkel\ProjectOrganizer\Domain\Model\ProjectList;

/**
 * Class InstitutionRepository
 * @package AlexGunkel\ProjectOrganizer\Domain\Repository
 *
 * @codeCoverageIgnore
 */
class InstitutionRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     *
     */
    private const propertyRepositories = [
        'topics' => TopicRepository::class,
        'wskelements' => WskelementRepository::class,
    ];

    public function initializeObject() {
        /** @var Typo3QuerySettings $querySettings */
        $querySettings = $this->objectManager->get(Typo3QuerySettings::class);
        $this->setDefaultQuerySettings($querySettings->setRespectStoragePage(false));
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \TYPO3\CMS\Extbase\Persistence\Repository::findAll()
     */
    public function findAll(): QueryResultInterface
    {
        $institutions = parent::findAll();
        if ($institutions->count() === 0) {
            return $institutions;
        }
        
        /**
         * 
         * @var ProjectRepository $projectRepository
         */
        $projectRepository = $this->objectManager->get(ProjectRepository::class);
        $projectRepository->setStoragePidIgnore(true);

        /** @var Institution $institution */
        foreach ($institutions as $institution) {
            $projects = $projectRepository->findAcceptedByInstitution($institution->getUid());

            /** @var Project $project */
            foreach ($projects->toArray() as $project) {
                $institution->addProject($project);
            }
        }

        $projectRepository->setStoragePidIgnore(false);
        return $institutions;
    }

    /**
     * @param mixed $identifier
     * @return object
     */
    public function findByIdentifier($identifier)
    {
        /** @var Institution $result */
        $result = parent::findByIdentifier($identifier);

        /**
         *
         * @var ProjectRepository $projectRepository
         */
        $projectRepository = $this->objectManager->get(ProjectRepository::class);
        $projectRepository->setStoragePidIgnore(true);

        $projects = $projectRepository->findAcceptedByInstitution($result->getUid());

        /** @var Project $project */
        foreach ($projects->toArray() as $project) {
            $result->addProject($project);
        }

        return $result;
    }

    public function insert(Institution $institution): void
    {
        parent::add($institution);
        $this->persistenceManager->persistAll();
    }

    /**
     * @return array
     */
    public function getPropertyOptions(): array
    {
        return array_map(
            function ($var) {
                return $this->objectManager->get($var)->findAll();
            },
            self::propertyRepositories
        );
    }
}
