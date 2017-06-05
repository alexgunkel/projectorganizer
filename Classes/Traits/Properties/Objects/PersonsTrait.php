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

namespace AlexGunkel\ProjectOrganizer\Traits\Properties\Objects;

use AlexGunkel\ProjectOrganizer\Domain\Model\Person;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

trait PersonsTrait
{
    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AlexGunkel\ProjectOrganizer\Domain\Model\Person>
     * @lazy
     */
    protected $persons;

    /**
     * @param \AlexGunkel\ProjectOrganizer\Domain\Model\Person $person
     *
     * @return void
     */
    public function addPerson(Person $person)
    {
        $this->persons->attach($person);
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AlexGunkel\ProjectOrganizer\Domain\Model\Person>
     */
    public function setPersons(ObjectStorage $wsk)
    {
        $this->persons = $wsk;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AlexGunkel\ProjectOrganizer\Domain\Model\Person>
     */
    public function getPersons() : ObjectStorage
    {
        return clone $this->persons;
    }
}