<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 13.08.17
 * Time: 12:32
 */

namespace AlexGunkel\ProjectOrganizer\AccessValidator;


use AlexGunkel\ProjectOrganizer\Management\AccessValidation\AcceptanceManagerInterface;

class AcceptanceManager implements AcceptanceManagerInterface
{
    /**
     * @var \DateTimeInterface
     */
    private $accepted = null;

    /**
     * @var int
     */
    private $acceptedBy = null;

    public function setAccepted(\DateTimeInterface $acceptanceDate) : AcceptanceManager
    {
        $this->accepted = $acceptanceDate;

        return $this;
    }

    public function getAccepted() : \DateTimeInterface
    {
        return $this->accepted;
    }

    public function isAccepted() : bool
    {
        return null !== $this->accepted;
    }

    public function getAcceptedBy() : int
    {
        return $this->acceptedBy;
    }

    public function setAcceptedBy(int $accepter) : AcceptanceManager
    {
        $this->acceptedBy = $accepter;

        return $this;
    }

    public function initializeAsNotYetAccepted() : AcceptanceManager
    {
        $this->accepted = null;
        $this->acceptedBy = null;

        return $this;
    }
}