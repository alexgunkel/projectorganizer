<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 13.08.17
 * Time: 12:27
 */

namespace AlexGunkel\ProjectOrganizer\Management\AccessValidation;


interface AcceptanceManagerInterface
{
    public function setAccepted(\DateTimeInterface $acceptanceDate) : AcceptanceManagerInterface;
    public function getAccepted() : \DateTimeInterface;
    public function isAccepted() : bool;
    public function getAcceptedBy() : int;
    public function setAcceptedBy(int $accepter) : AcceptanceManagerInterface;
    public function initializeAsNotYetAccepted() : AcceptanceManagerInterface;
}