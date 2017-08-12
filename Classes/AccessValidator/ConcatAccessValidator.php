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

namespace AlexGunkel\ProjectOrganizer\AccessValidator;

use AlexGunkel\ProjectOrganizer\Management\AccessValidation\AccessValidatableInterface;
use AlexGunkel\ProjectOrganizer\Management\AccessValidation\AccessValidatorInterface;

class ConcatAccessValidator implements AccessValidatorInterface
{
    public function generateValidationCode(
        AccessValidatableInterface $accessValidatable
    ): string {
        return md5($accessValidatable->getTitle() . (string) $accessValidatable->getUid());
    }

    public function validate(
        AccessValidatableInterface $accessValidatable,
        string $validationCode
    ): bool {
        return $validationCode === $this->generateValidationCode($accessValidatable);
    }
}
