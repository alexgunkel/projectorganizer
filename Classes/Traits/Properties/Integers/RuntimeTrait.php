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

use AlexGunkel\ProjectOrganizer\Value\Runtime;

trait RuntimeTrait
{
    /**
     * @real_var \AlexGunkel\ProjectOrganizer\Value\Runtime
     * @var int
     *
     * @validate NotEmpty
     */
    protected $runtime;

    /**
     * @param int $runtime
     *
     * @return void
     */
    public function setRunTime(int $runtime)
    {
        $this->runtime = $runtime;
    }

    public function getRuntime(): int
    {
        return $this->runtime;
    }
}