<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 13.08.17
 * Time: 12:32
 */

namespace AlexGunkel\ProjectOrganizer\AccessValidation;

use AlexGunkel\ProjectOrganizer\Domain\Model\Project;
use AlexGunkel\ProjectOrganizer\Domain\Model\Validation\State;
use AlexGunkel\ProjectOrganizer\Value\ValidationStatus;

class AcceptanceManager
{
    /**
     * @param Project $acceptable
     *
     * @return AcceptanceManager
     */
    public function accept(Project $acceptable) : AcceptanceManager
    {
        $acceptable->setValidationState(
            new State(
                new ValidationStatus(ValidationStatus::ACCEPTED)
            )
        );

        return $this;
    }

    /**
     * @param Project $acceptable
     *
     * @return bool
     */
    public function validate(Project $acceptable): bool
    {
        return $acceptable->getValidationState()->isAccepted();
    }

    /**
     * @param Project $acceptable
     *
     * @return AcceptanceManager
     */
    public function refuse(Project $acceptable): AcceptanceManager
    {
        $acceptable->setValidationState(
            new State(
                new ValidationStatus(ValidationStatus::REJECTED)
            )
        );

        return $this;
    }

    /**
     * @param Project $acceptable
     *
     * @return AcceptanceManager
     */
    public function initializeAsNotYetAccepted(Project $acceptable) : AcceptanceManager
    {
        $acceptable->setValidationState(
            new ValidationStatus(ValidationStatus::OPEN)
        );

        return $this;
    }
}