<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 13.08.17
 * Time: 12:32
 */

namespace AlexGunkel\ProjectOrganizer\AccessValidation;

use AlexGunkel\ProjectOrganizer\Domain\Model\Project;
use AlexGunkel\ProjectOrganizer\Domain\Model\Validatable;
use AlexGunkel\ProjectOrganizer\Domain\Model\Validation\State;
use AlexGunkel\ProjectOrganizer\Value\ValidationStatus;

class AcceptanceManager
{
    /**
     * @param Project $acceptable
     *
     * @return AcceptanceManager
     */
    public function accept(Validatable $acceptable) : AcceptanceManager
    {
        $acceptable->setValidationState(Project::VALIDATION_STATE_ACCEPTED);

        return $this;
    }

    /**
     * @param Project $acceptable
     *
     * @return bool
     */
    public function validate(Validatable $acceptable): bool
    {
        return Project::VALIDATION_STATE_ACCEPTED === $acceptable->getValidationState();
    }

    /**
     * @param Project $acceptable
     *
     * @return AcceptanceManager
     */
    public function refuse(Validatable $acceptable): AcceptanceManager
    {
        $acceptable->setValidationState(Project::VALIDATION_STATE_REJECTED);

        return $this;
    }

    /**
     * @param Project $acceptable
     *
     * @return AcceptanceManager
     */
    public function initializeAsNotYetAccepted(Validatable $acceptable) : AcceptanceManager
    {
        $acceptable->setValidationState(Project::VALIDATION_STATE_OPEN);

        return $this;
    }
}