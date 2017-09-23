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
    public function accept(AcceptableInterface $acceptable) : AcceptanceManagerInterface;
    public function refuse(AcceptableInterface $acceptable) : AcceptanceManagerInterface;

    public function initializeAsNotYetAccepted(
        AcceptableInterface $acceptable
    ) : AcceptanceManagerInterface;
}