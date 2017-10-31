<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 13.08.17
 * Time: 12:32
 */

namespace AlexGunkel\ProjectOrganizer\AccessValidation;

use AlexGunkel\ProjectOrganizer\Domain\Model\Validation\State;
use AlexGunkel\ProjectOrganizer\Value\ValidationStatus;

class AcceptanceManager implements AcceptanceManagerInterface
{
    /**
     * @param AcceptableInterface $acceptable
     *
     * @return AcceptanceManagerInterface
     */
    public function accept(AcceptableInterface $acceptable) : AcceptanceManagerInterface
    {
        $acceptable->setValidationState(
            new State(
                new ValidationStatus(ValidationStatus::ACCEPTED)
            )
        );

        return $this;
    }

    /**
     * @param AcceptableInterface $acceptable
     *
     * @return AcceptanceManagerInterface
     */
    public function refuse(AcceptableInterface $acceptable): AcceptanceManagerInterface
    {
        $acceptable->setValidationState(
            new State(
                new ValidationStatus(ValidationStatus::REJECTED)
            )
        );

        return $this;
    }

    /**
     * @param AcceptableInterface $acceptable
     *
     * @return AcceptanceManagerInterface
     */
    public function initializeAsNotYetAccepted(AcceptableInterface $acceptable) : AcceptanceManagerInterface
    {
        $acceptable->setValidationState(
            new State(
                new ValidationStatus(ValidationStatus::OPEN)
            )
        );

        return $this;
    }
}