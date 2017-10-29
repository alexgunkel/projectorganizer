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

use AlexGunkel\ProjectOrganizer\Domain\Model\ManagableInterface;
use AlexGunkel\ProjectOrganizer\Value\AcceptanceState;

trait AcceptedTrait
{
    /**
     * @var AcceptanceState
     */
    protected $accepted;

    /**
     * @var int
     */
    protected $acceptedBy = null;

    public function setAccepted(int $acceptanceDate) : ManagableInterface
    {
        $this->accepted = $acceptanceDate;

        return $this;
    }

    public function getAccepted() : int
    {
        return $this->accepted;
    }

    public function isAccepted() : bool
    {
        return null !== $this->accepted;
    }

    public function getAcceptedBy() : int
    {
        return $this->acceptedBy;
    }

    public function setAcceptedBy(int $accepter) : ManagableInterface
    {
        $this->acceptedBy = $accepter;

        return $this;
    }

    public function initializeAsNotYetAccepted() : ManagableInterface
    {
        $this->accepted = null;
        $this->acceptedBy = null;

        return $this;
    }
}