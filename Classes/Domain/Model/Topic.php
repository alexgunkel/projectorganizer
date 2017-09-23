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

namespace AlexGunkel\ProjectOrganizer\Domain\Model;

use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\InstitutionsTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\PersonsTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Strings\TitleTrait;
use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Topic extends AbstractDomainObject
{
    use TitleTrait;
    use InstitutionsTrait;
    use PersonsTrait;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AlexGunkel\ProjectOrganizer\Domain\Model\Project>
     * @lazy
     */
    protected $projects;

    /**
     * @param \AlexGunkel\ProjectOrganizer\Domain\Model\Project $project
     *
     * @return void
     */
    public function addProject(Project $project)
    {
        $this->projects->attach($project);
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AlexGunkel\ProjectOrganizer\Domain\Model\Project>
     */
    public function setProjects(ObjectStorage $wsk)
    {
        $this->projects = $wsk;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AlexGunkel\ProjectOrganizer\Domain\Model\Project>
     */
    public function getProjects() : ObjectStorage
    {
        $projects = clone $this->projects;
        /** @var Project $project */
        foreach ($projects as $project) {
            if ($project->getAccepted() <= 0) {
                $projects->offsetUnset($project);
            }
        }
        return $projects;
    }
}