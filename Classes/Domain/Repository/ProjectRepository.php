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
use AlexGunkel\ProjectOrganizer\Management\EditableRepositoryInterface;
use AlexGunkel\ProjectOrganizer\Management\ManagableRepository;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

class ProjectRepository
    extends \TYPO3\CMS\Extbase\Persistence\Repository
    implements ManagableRepository, EditableRepositoryInterface
{
    private const propertyRepositories = [
        'topics' => TopicRepository::class,
        'statusOptions' => StatusRepository::class,
        'regions' => RegionRepository::class,
        'wskelements' => WskelementRepository::class,
    ];

    public function initializeObject() {
        /** @var Typo3QuerySettings $querySettings */
        $querySettings = $this->objectManager->get(Typo3QuerySettings::class);
        $this->setDefaultQuerySettings($querySettings->setRespectStoragePage(false));
    }

    /**
     * Find all accepted projects
     *
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findAccepted() : QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching($query->greaterThan('accepted', 0));
        return $query->execute();
    }

    /**
     * Find all open requests
     *
     * @return QueryResultInterface
     */
    public function findOpenRequests() : QueryResultInterface
    {
        $query = $this->createQuery();

        $query->matching(
            $query->logicalOr(
                [
                    $query->equals('accepted', null),
                    $query->equals('accepted', 0),
                ]
            )
        );

        return $query->execute();
    }

    public function findDenied() : QueryResultInterface
    {
        $query = $this->createQuery();

        $query->matching(
            $query->equals('accepted', -1)
        );

        return $query->execute();
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

?>
