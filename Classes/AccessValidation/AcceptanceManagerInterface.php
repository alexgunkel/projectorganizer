<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 13.08.17
 * Time: 12:27
 */

namespace AlexGunkel\ProjectOrganizer\AccessValidation;


use AlexGunkel\ProjectOrganizer\Domain\Model\User\Manager;

interface AcceptanceManagerInterface
{
    public function accept(AcceptableInterface $acceptable);
    public function setAccepted(
        AcceptableInterface $acceptable,
        \DateTimeInterface $acceptanceDate
    ) : AcceptanceManagerInterface;

    public function getAccepted(
        AcceptableInterface $acceptable
    ) : \DateTimeInterface;

    public function isAccepted(
        AcceptableInterface $acceptable
    ) : bool;

    public function getAcceptedBy(
        AcceptableInterface $acceptable
    ) : Manager;

    public function setAcceptedBy(
        AcceptableInterface $acceptable,
        Manager $accepter
    ) : AcceptanceManagerInterface;

    public function initializeAsNotYetAccepted(
        AcceptableInterface $acceptable
    ) : AcceptanceManagerInterface;
}