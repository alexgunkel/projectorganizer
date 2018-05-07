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

use AlexGunkel\ProjectOrganizer\Traits\Properties\Strings\TitleTrait;
use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;

class Institution extends AbstractDomainObject
{
    use TitleTrait;
    
    /**
     * 
     * @var ProjectList
     */
    protected $projectList;

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
     * @var \AlexGunkel\ProjectOrganizer\Domain\Model\Topic
     */
    protected $topic;

    /**
     * @var \AlexGunkel\ProjectOrganizer\Domain\Model\Wskelement
     */
    protected $wskelement;
    
    public function __construct()
    {
        $this->projectList = new ProjectList;
    }

    /**
     * @return string
     */
    public function getInstitutionType(): string
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
    public function getLocation(): string
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
    public function getCountry(): string
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
     * @return Topic
     */
    public function getTopic(): ?Topic
    {
        return $this->topic;
    }

    /**
     * @param Topic $topic
     */
    public function setTopic(Topic $topic)
    {
        $this->topic = $topic;
    }

    /**
     * @return Wskelement
     */
    public function getWskelement(): ?Wskelement
    {
        return $this->wskelement;
    }

    /**
     * @param Wskelement $wskelement
     */
    public function setWskelement(Wskelement $wskelement)
    {
        $this->wskelement = $wskelement;
    }
    
    public function getProjects(): ProjectList
    {
        return $this->projectList;
    }
    
    public function setProjectList(ProjectList $projects): void
    {
        $this->projectList = $projects;    
    }
    
    public function __toString(): string
    {
        return $this->title;
    }
}

