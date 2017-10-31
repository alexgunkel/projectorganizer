<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 31.10.17
 * Time: 14:53
 */

namespace AlexGunkel\ProjectOrganizer\Domain\Model\Validation;

use AlexGunkel\ProjectOrganizer\Value\AcceptanceDate;
use AlexGunkel\ProjectOrganizer\Value\ValidationStatus;

class State
{
    /**
     * timestamp of acceptance date, not accepted if zero
     *
     * @var ValidationStatus
     */
    private $status;

    /**
     * @var AcceptanceDate
     */
    private $date;

    /**
     * State constructor.
     *
     * @param ValidationStatus|null $status
     */
    public function __construct(ValidationStatus $status = null)
    {
        $this->status = $status ?: new ValidationStatus();
    }

    /**
     * @return bool
     */
    public function isAccepted(): bool
    {
        return $this->status->isValidated();
    }

    /**
     * @param int $accepted
     *
     * @return State
     */
    public function setStatus(int $accepted): self
    {
        $this->status = new ValidationStatus($accepted);

        return $this;
    }

    public function getStatus(): ValidationStatus
    {
        return $this->status;
    }

    public function setAcceptanceDate(int $date): self
    {
        $this->date = new AcceptanceDate($date);

        return $this;
    }

    public function getAcceptanceDate(): AcceptanceDate
    {
        return $this->date;
    }
}