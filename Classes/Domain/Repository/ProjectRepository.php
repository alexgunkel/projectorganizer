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
use Doctrine\Common\Util\Debug;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * Class ProjectRepository
 * @package AlexGunkel\ProjectOrganizer\Domain\Repository
 *
 * @codeCoverageIgnore
 */
class ProjectRepository
    extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     *
     */
    private const propertyRepositories = [
        'topics' => TopicRepository::class,
        'statusOptions' => StatusRepository::class,
        'regions' => RegionRepository::class,
        'wskelements' => WskelementRepository::class,
        'institutions' => InstitutionRepository::class,
    ];

    /**
     * @param Project $project
     * @param int $pageId
     */
    public function addToStorage(Project $project, int $pageId): void
    {
        $project->setPid($pageId);
        $this->add($project);
    }
    
    public function findAcceptedByInstitution(int $institution): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->equals(
                    'institutions',
                    $institution
                    ),
                $query->greaterThanOrEqual(
                    'validation_state',
                    Project::VALIDATION_STATE_ACCEPTED
                )
            )
        );
        $result = $query->execute();

        return $result;
    }

    /**
     * @param int $topicUid
     * @return QueryResultInterface
     */
    public function findAcceptedByTopicUid(int $topicUid): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd(
                $query->greaterThanOrEqual(
                    'validation_state',
                    Project::VALIDATION_STATE_ACCEPTED
                ),
                $query->equals(
                    'topics.uid',
                    $topicUid
                )
            )
        );

        DebuggerUtility::var_dump($query->execute());
        return $query->execute();
    }

    public function findAcceptedByFilter(array $filter): QueryResultInterface
    {
        $query = $this->createQuery();
        array_walk(
            $filter,
            function (&$value, string $key) use ($query) {
                $value = $query->equals(
                    $key . '.uid',
                    $value
                );
            }
        );
        $criteria = array_merge(
            [
                $query->greaterThanOrEqual(
                    'validation_state',
                    Project::VALIDATION_STATE_ACCEPTED
                ),
            ],
            $filter
        );

        $query->matching(
            call_user_func_array([$query, 'logicalAnd'], $criteria)
        );

        var_dump($query->getStatement());
        return $query->execute();
    }

    /**
     * Find all accepted projects
     *
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findAccepted(bool $ignoreStoragePid = false) : QueryResultInterface
    {
        $ignoreStoragePid && $this->setStoragePidIgnore(true);

        $query = $this->createQuery();
        $query->matching($query->greaterThanOrEqual('validation_state', Project::VALIDATION_STATE_ACCEPTED));
        $result = $query->execute();
        
        $ignoreStoragePid && $this->setStoragePidIgnore(false);
        return $result;
    }

    public function findAcceptedWithSearchTerm(string $term): QueryResultInterface
    {
        $query = $this->createQuery();
        $query->matching(
            $query->logicalAnd([
                $query->greaterThanOrEqual('validation_state', Project::VALIDATION_STATE_ACCEPTED),
                $query->logicalOr([
                    $query->like('title', '%' . $term . '%'),
                    $query->like('description', '%' . $term . '%'),
                ]),
            ])
        );

        return $query->execute();
    }

    /**
     * Find all open requests
     *
     * @return QueryResultInterface
     */
    public function findOpenRequests(bool $ignoreStoragePid = false) : QueryResultInterface
    {
        $ignoreStoragePid && $this->setStoragePidIgnore(true);
        $query = $this->createQuery();

        $query->matching(
            $query->logicalOr(
                [
                    $query->equals('validation_state', null),
                    $query->equals('validation_state', 0),
                ]
            )
        );

        $result = $query->execute();
        $ignoreStoragePid && $this->setStoragePidIgnore(false);
        return $result;
    }

    /**
     * @return QueryResultInterface
     */
    public function findDenied(bool $ignoreStoragePid = false) : QueryResultInterface
    {
        $ignoreStoragePid && $this->setStoragePidIgnore(true);
        $query = $this->createQuery();

        $query->matching(
            $query->equals('validation_state', -1)
        );

        $result = $query->execute();
        $ignoreStoragePid && $this->setStoragePidIgnore(false);
        return $result;
    }

    /**
     * Replaces an existing object with the same identifier by the given object
     *
     * @param object $modifiedObject
     */
    public function findLatestParent(Project $lastPublished)
    {
        for ($i = 0; $i < 10; $i++) {
            $uid = $lastPublished->getUid();
            $query = $this->createQuery();
            $query->matching(
                $query->equals('orig', $uid)
            );

            $result = $query->execute()->getFirst();

            if (empty($result)) {
                break;
            }

            $lastPublished = $result;
        }

        return $lastPublished;
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
    
    /**
     * 
     * @param bool $ignore
     */
    public function setStoragePidIgnore(bool $ignore): void
    {
        /** @var Typo3QuerySettings $querySettings */
        $querySettings = $this->objectManager->get(Typo3QuerySettings::class);
        $this->setDefaultQuerySettings($querySettings->setRespectStoragePage(!$ignore));
    }
}

?>
