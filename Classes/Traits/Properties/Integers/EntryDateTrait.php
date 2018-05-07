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

namespace AlexGunkel\ProjectOrganizer\Traits\Properties\Integers;

trait EntryDateTrait
{
    /**
     * @var string
     */
    protected $entryDate;

    /**
     * @param int $entryDate
     *
     * @return void
     */
    public function setEntryDate(string $entryDate)
    {
        $this->entryDate = $entryDate;
    }

    public function getEntryDate(): ?string
    {
        return $this->entryDate;
    }

    public function getEntryDateAsString(): string
    {
        return $this->entryDate;
    }
}