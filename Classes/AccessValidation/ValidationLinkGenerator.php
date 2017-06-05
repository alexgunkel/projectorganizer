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

use AlexGunkel\ProjectOrganizer\AccessValidation\AccessValidatableInterface,
    AlexGunkel\ProjectOrganizer\AccessValidation\AccessValidatorInterface;

class ValidationLinkGenerator
{
    /**
     * @var \AlexGunkel\ProjectOrganizer\AccessValidation\AccessValidatorInterface
     */
    private $validator;

    public function __construct(
        AccessValidatorInterface $validator
    ) {
        $this->validator = $validator;
    }

    public function generateLink(
        AccessValidatableInterface $object,
        int $targetPageUid
    ) : string {
        return $_SERVER['HTTP_HOST'] . '/index.php?id=' . $targetPageUid . '&code=' . $this->validator->generateValidationCode($object);
    }
}