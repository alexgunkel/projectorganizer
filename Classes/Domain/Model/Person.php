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

namespace AlexGunkel\ProjectOrganizer\Domain\Model;


use AlexGunkel\ProjectOrganizer\Traits\Properties\Integers\EntryDateTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\InstitutionsTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\TopicsTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\WskelementTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Strings\DescriptionTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Strings\SpecialistFieldTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Strings\TitleTrait;
use AlexGunkel\ProjectOrganizer\Value\Password;
use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;

class Person extends AbstractDomainObject implements Validatable
{
    use TitleTrait;
    use DescriptionTrait;
    use TopicsTrait;
    use InstitutionsTrait;
    use SpecialistFieldTrait;
    use EntryDateTrait;
    use WskelementTrait;

    public const VALIDATION_STATE_OPEN     = 0;
    public const VALIDATION_STATE_ACCEPTED = 1;
    public const VALIDATION_STATE_REJECTED = -1;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var int
     */
    protected $validationState;

    /**
     * @var string
     */
    protected $passwordHash;

    /**
     * @var Password
     */
    protected $password;

    /**
     * @return int
     */
    public function getValidationState(): int
    {
        return $this->validationState;
    }

    /**
     * @param int $validationState
     */
    public function setValidationState(int $validationState)
    {
        $this->validationState = $validationState;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @param string $passwordHash
     */
    public function setPasswordHash(string $passwordHash)
    {
        $this->passwordHash = $passwordHash;
    }

    /**
     * @return Password
     */
    public function getPassword(): Password
    {
        return $this->password;
    }

    /**
     * @param Password $password
     */
    public function setPassword(Password $password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
}