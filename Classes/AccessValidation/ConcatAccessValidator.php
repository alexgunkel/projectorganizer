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

namespace AlexGunkel\ProjectOrganizer\AccessValidation;


use AlexGunkel\ProjectOrganizer\Domain\Model\Project;

class ConcatAccessValidator implements AccessValidatorInterface
{
    public function generateValidationCode(
        Project $accessValidatable
    ): string {
        return md5($accessValidatable->getTitle() . (string) $accessValidatable->getUid());
    }

    public function validate(
        Project $accessValidatable,
        string $validationCode
    ): bool {
        return $validationCode === $this->generateValidationCode($accessValidatable);
    }
}
