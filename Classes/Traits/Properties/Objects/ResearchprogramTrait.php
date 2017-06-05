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

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

trait ResearchprogramTrait
{
    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AlexGunkel\ProjectOrganizer\Domain\Model\Researchprogram>
     * @lazy
     */
    protected $researchprograms;

    /**
     * @param \AlexGunkel\ProjectOrganizer\Domain\Model\Researchprogram $researchprogram
     *
     * @return void
     */
    public function addResearchprogram(\AlexGunkel\ProjectOrganizer\Domain\Model\Researchprogram $researchprogram)
    {
        $this->researchprograms->attach($researchprogram);
    }

    public function setResearchprograms(ObjectStorage $program)
    {
        $this->researchprograms = $program;
    }

    public function getResearchprograms() : ObjectStorage
    {
        return clone $this->researchprograms;
    }
}