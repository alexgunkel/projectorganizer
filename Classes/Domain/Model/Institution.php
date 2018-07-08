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

use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\TopicsTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\WskelementTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Strings\TitleTrait;
use AlexGunkel\ProjectOrganizer\Value\Password;
use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Class Institution
 * @package AlexGunkel\ProjectOrganizer\Domain\Model
 */
class Institution extends AbstractDomainObject implements Validatable
{
    use TitleTrait,
        TopicsTrait,
        WskelementTrait;

    public const VALIDATION_STATE_OPEN     = 0;
    public const VALIDATION_STATE_ACCEPTED = 1;
    public const VALIDATION_STATE_REJECTED = -1;

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
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AlexGunkel\ProjectOrganizer\Domain\Model\Project>
     */
    protected $projects;

    /**
     * @var string
     */
    protected $institutionType;

    /**
     * @var string
     */
    protected $location;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var string
     */
    protected $state;

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state)
    {
        $this->state = $state;
    }

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
    public function getPasswordHash(): ?string
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
    public function getPassword(): ?Password
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
     * Institution constructor.
     */
    public function __construct()
    {
        $this->projects = new ObjectStorage;
        $this->topics = new ObjectStorage;
        $this->wskelements = new ObjectStorage;
    }

    /**
     * @return string
     */
    public function getInstitutionType(): ?string
    {
        return $this->institutionType;
    }

    /**
     * @param string $institutionType
     */
    public function setInstitutionType(string $institutionType)
    {
        $this->institutionType = $institutionType;
    }

    /**
     * @return string
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation(string $location)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country)
    {
        $this->country = $country;
    }

    /**
     * @return null|ObjectStorage
     */
    public function getProjects(): ?ObjectStorage
    {
        return $this->projects;
    }

    /**
     * @param ObjectStorage $projects
     */
    public function setProjects(ObjectStorage $projects): void
    {
        $this->projects = $projects;
    }

    /**
     * @param \AlexGunkel\ProjectOrganizer\Domain\Model\Project $topic
     *
     * @return void
     */
    public function addProject(Project $topic)
    {
        if (null === $this->projects) {
            $this->projects = new ObjectStorage;
        }
        $this->projects->attach($topic);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->title;
    }
}

