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

namespace AlexGunkel\ProjectOrganizer\Traits\Properties\Strings;

use AlexGunkel\ProjectOrganizer\Value\Description;

trait DescriptionTrait
{
    /**
     * @var string
     */
    protected $description = '';

    /**
     * @param Description $title
     *
     * @return self
     */
    public function setDescription(Description $description): self
    {
        $this->description = (string) $description;

        return $this;
    }

    /**
     * @return Description
     */
    public function getDescription() : Description
    {
        return new Description($this->description);
    }
}