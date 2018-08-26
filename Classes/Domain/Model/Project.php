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

use AlexGunkel\ProjectOrganizer\Traits\Properties\Booleans\DeletedTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Booleans\HiddenTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Integers\CrDateTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Integers\OverallVolumeTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Integers\RuntimeTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Integers\TstampTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Integers\VolumeTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\ContactPersonTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\PublicationsTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\RegionTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\ResearchprogramTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\StatusTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\TopicsTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\WskelementTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Strings\DescriptionTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Strings\LinkTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Strings\TitleTrait;
use AlexGunkel\ProjectOrganizer\Traits\ValidationStatusTrait;
use AlexGunkel\ProjectOrganizer\Value\Password;
use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class Project
    extends AbstractDomainObject implements Validatable
{
    use ContactPersonTrait;
    use DescriptionTrait;
    use LinkTrait;
    use OverallVolumeTrait;
    use PublicationsTrait;
    use RegionTrait;
    use ResearchprogramTrait;
    use RuntimeTrait;
    use StatusTrait;
    use TitleTrait;
    use TopicsTrait;
    use VolumeTrait;
    use WskelementTrait;

    use HiddenTrait;
    use DeletedTrait;
    use CrDateTrait;
    use TstampTrait;

    public const VALIDATION_STATE_OPEN     = 0;
    public const VALIDATION_STATE_ACCEPTED = 1;
    public const VALIDATION_STATE_REJECTED = -1;
    private const VALIDATION_STATES = [
        self::VALIDATION_STATE_ACCEPTED,
        self::VALIDATION_STATE_OPEN,
        self::VALIDATION_STATE_REJECTED,
    ];

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
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AlexGunkel\ProjectOrganizer\Domain\Model\Institution>
     */
    protected $institutions;

    /**
     * @var string
     */
    protected $location;

    /**
     * @var string
     *
     * @validate NotEmpty
     */
    protected $contactEmail;

    /**
     * @var bool
     */
    protected $showInMap;

    /**
     * @var bool
     */
    protected $hypos;

    /**
     * @var \AlexGunkel\ProjectOrganizer\Domain\Model\Project
     */
    protected $orig;

    /**
     * @var string
     */
    protected $researchprogram;

    /**
     * @var bool
     */
    protected $demoProject;

    /**
     * @var string|null
     */
    protected $geoLocationX;

    /**
     * @var string|null
     */
    protected $geoLocationY;

    /**
     * @return null|string
     */
    public function getGeoLocationX()
    {
        return $this->geoLocationX;
    }

    /**
     * @param null|string $geoLocationX
     * @return Project
     */
    public function setGeoLocationX($geoLocationX)
    {
        $this->geoLocationX = $geoLocationX;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getGeoLocationY()
    {
        return $this->geoLocationY;
    }

    /**
     * @param null|string $geoLocationY
     * @return Project
     */
    public function setGeoLocationY($geoLocationY)
    {
        $this->geoLocationY = $geoLocationY;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDemoProject(): bool
    {
        return $this->demoProject ?? false;
    }

    /**
     * @param bool $demoProject
     */
    public function setDemoProject(bool $demoProject)
    {
        $this->demoProject = $demoProject;
    }

    /**
     * @return string
     */
    public function getResearchprogram(): string
    {
        return $this->researchprogram ?? '';
    }

    /**
     * @param string $researchprogram
     */
    public function setResearchprogram(string $researchprogram)
    {
        $this->researchprogram = $researchprogram;
    }

    /**
     * @return Project
     */
    public function getOrig(): ?Project
    {
        return $this->orig;
    }

    /**
     * @param Project $orig
     *
     * @return self
     */
    public function setOrig(Project $orig)
    {
        $this->orig = $orig;

        return $this;
    }

    /**
     * @return bool
     */
    public function isHypos(): bool
    {
        return $this->hypos ?? false;
    }

    /**
     * @param bool $hypos
     */
    public function setHypos(bool $hypos)
    {
        $this->hypos = $hypos;
    }

    /**
     * @return bool
     */
    public function isShowInMap(): bool
    {
        return $this->showInMap ?? false;
    }

    /**
     * @param bool $showInMap
     */
    public function setShowInMap(bool $showInMap)
    {
        $this->showInMap = $showInMap;
    }

    /**
     * @return string
     */
    public function getContactEmail(): string
    {
        return $this->contactEmail ?? '';
    }

    /**
     * @param string $contactEmail
     */
    public function setContactEmail(string $contactEmail)
    {
        $this->contactEmail = $contactEmail;
    }

    /**
     * @return string
     */
    public function getLocation(): ?string
    {
        return $this->location ?? '';
    }

    /**
     * @param string $location
     */
    public function setLocation(string $location)
    {
        $this->location = $location;
    }

    public function copy(): Project
    {
        $clone = new Project;
        $listOfProperties = get_object_vars($this);

        foreach ($listOfProperties as $property => $value) {
            $name = 'set' . ucfirst($property);
            if (method_exists($clone, $name) && null !== $value) {
                $clone->{$name}($value);
            }
        }

        return $clone;
    }

    /**
     * @param int $accepted
     *
     * @throws \Exception if validation-state is not allowed
     *
     * @return void
     */
    public function setValidationState(int $accepted)
    {
        if (!in_array($accepted, self::VALIDATION_STATES)) {
            throw new \Exception('Tried to set non-existing validation-state. Allowed: '
                    . implode(', ', self::VALIDATION_STATES)
                    . '; tried to set: ' . $accepted,
                1522784874
            );
        }

        $this->validationState = $accepted;
    }

    /**
     * @return int
     */
    public function getValidationState(): int
    {
        return $this->validationState;
    }

    /**
     * @param \AlexGunkel\ProjectOrganizer\Domain\Model\Institution $institution
     *
     * @return void
     */
    public function addInstitution(Institution $institution)
    {
        $this->institutions->attach($institution);
    }

    /**
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AlexGunkel\ProjectOrganizer\Domain\Model\Institution>
     */
    public function setInstitutions(ObjectStorage $institutions)
    {
        $this->institutions = $institutions;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AlexGunkel\ProjectOrganizer\Domain\Model\Institution>
     */
    public function getInstitutions() : ObjectStorage
    {
        return $this->institutions ?? new ObjectStorage;
    }

    /**
     * Project constructor.
     */
    public function __construct()
    {
        $this->setTopics(new ObjectStorage());
        $this->setPublications(new ObjectStorage());
        $this->setWskelements(new ObjectStorage());
        $this->institutions = new ObjectStorage;
        $this->setResearchprograms(new ObjectStorage());
        $this->setValidationState(self::VALIDATION_STATE_OPEN);
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash ?? '';
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

    public function toArray(): array
    {
    }
}
