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
        
        $projectRepository = $this->objectManager->get(ProjectRepository::class);
        
        foreach ($institutions as $institution) {
            $projects = $projectRepository->findAcceptedByInstitution($institution->getUid());
            $institution->setProjectList(new ProjectList($projects->toArray()));
        }
        
        return $institutions;
    }
    
    public function insert(Institution $institution): void
    {
        parent::add($institution);
        $this->persistenceManager->persistAll();
    }
}
