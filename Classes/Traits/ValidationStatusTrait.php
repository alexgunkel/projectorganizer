<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 11.11.17
 * Time: 19:48
 */

namespace AlexGunkel\ProjectOrganizer\Traits;


use AlexGunkel\ProjectOrganizer\Domain\Model\Validation\State;
use AlexGunkel\ProjectOrganizer\Value\ValidationStatus;

trait ValidationStatusTrait
{
    /**
     * @var bool
     */
    private $isValidated;

    /**
     * @var \AlexGunkel\ProjectOrganizer\Domain\Model\Validation\State
     */
    private $validationState;

    /**
     * @param State $accepted
     *
     * @return Project
     */
    public function setValidationState(ValidationStatus $accepted): self
    {
        $this->validationState = $accepted;

        return $this;
    }

    /**
     * @return State
     */
    public function getValidationState(): State
    {
        return $this->validationState ?: new State(new ValidationStatus(ValidationStatus::OPEN));
    }

}