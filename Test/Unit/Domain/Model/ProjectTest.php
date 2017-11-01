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

namespace AlexGunkel\ProjectOrganizerTest;


use AlexGunkel\ProjectOrganizer\Domain\Model\Institution;
use AlexGunkel\ProjectOrganizer\Domain\Model\Project;
use AlexGunkel\ProjectOrganizer\Domain\Model\Publication;
use AlexGunkel\ProjectOrganizer\Domain\Model\Researchprogram;
use AlexGunkel\ProjectOrganizer\Domain\Model\Topic;
use AlexGunkel\ProjectOrganizer\Domain\Model\Wskelement;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class ProjectTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function anInstanceOfProjectCanBeConstructed()
    {
        $project = new Project;
        $project->setTitle('name');
        $this->assertEquals(
            'name',
            $project->getTitle()
        );
    }

    /**
     * @test
     * @dataProvider objectStorages
     */
    public function theTopicsAreInitializedAsEmptyObjectStorage($property, $className) {
        $project = new Project;
        $methodName = 'get' . ucfirst($property);
        $this->assertEquals(ObjectStorage::class,
            get_class($project->$methodName()));
        $this->assertEquals(0, count($project->$methodName()));
    }

    /**
     * @test
     * @dataProvider objectStorages
     */
    public function topicsCanBeStored($property, $className)
    {
        $project = new Project;
        $addMethod = 'add' . ucfirst(substr($property, 0, -1));
        $getMethod = 'get' . ucfirst($property);
        $project->$addMethod(new $className);
        $this->assertEquals(
            1,
            count($project->$getMethod())
        );
    }

    /**
     * A dataprovider for tehe object storages
     *
     * @return array
     */
    public function objectStorages()
    {
        return array(
            array('topics', Topic::class),
            array('institutions', Institution::class),
            array('publications', Publication::class),
            array('wskelements', Wskelement::class),
            array('researchprograms', Researchprogram::class),
        );
    }
}