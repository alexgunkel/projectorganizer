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

use AlexGunkel\ProjectOrganizer\AccessValidation\AcceptableInterface;
use AlexGunkel\ProjectOrganizer\Domain\Model\User\DummyManager;
use AlexGunkel\ProjectOrganizer\Domain\Model\User\Manager;
use AlexGunkel\ProjectOrganizer\Management\AccessValidation\AcceptanceManagerInterface;
use AlexGunkel\ProjectOrganizer\Management\AccessValidation\AccessValidatableInterface;
use AlexGunkel\ProjectOrganizer\Management\ManagableInterface;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Booleans\HiddenTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Integers\CrDateTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Integers\OverallVolumeTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Integers\RuntimeTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Integers\TstampTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Integers\VolumeTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\ContactPersonTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\InstitutionsTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\PublicationsTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\RegionTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\ResearchprogramTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\StatusTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\TopicsTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Objects\WskelementTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Strings\DescriptionTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Strings\LinkTrait;
use AlexGunkel\ProjectOrganizer\Traits\Properties\Strings\TitleTrait;
use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Project
    extends AbstractDomainObject
    implements AccessValidatableInterface, AcceptableInterface
{
    use TitleTrait;
    use DescriptionTrait;
    use TopicsTrait;
    use RuntimeTrait;
    use StatusTrait;
    use RegionTrait;
    use WskelementTrait;
    use ContactPersonTrait;
    use PublicationsTrait;
    use VolumeTrait;
    use OverallVolumeTrait;
    use ResearchprogramTrait;
    use LinkTrait;
    use InstitutionsTrait;
    use HiddenTrait;
    use CrDateTrait;
    use TstampTrait;

    protected $deleted;
    public function setDeleted(bool $deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * timestamp of acceptance date, not accepted if zero
     *
     * @var int
     */
    protected $accepted = 0;

    /**
     * @var \AlexGunkel\ProjectOrganizer\Domain\Model\User\Manager
     */
    protected $acceptedBy;

    public function getAccepted(): int
    {
        return $this->accepted;
    }

    public function setAccepted(int $accepted)
    {
        $this->accepted = $accepted;
    }

    public function getAcceptedBy() : Manager
    {
        return $this->acceptedBy ?: new DummyManager();
    }

    public function getAcceptingManagerUid(): int
    {
        return $this->acceptedBy;
    }

    public function setAcceptingManagerUid(int $managerUid)
    {
        $this->acceptedBy = $managerUid;
    }

    public function __construct()
    {
        $this->setTopics(new ObjectStorage());
        $this->setInstitutions(new ObjectStorage());
        $this->setPublications(new ObjectStorage());
        $this->setWskelements(new ObjectStorage());
        $this->setResearchprograms(new ObjectStorage());
    }
}
?>
