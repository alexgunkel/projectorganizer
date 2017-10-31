<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 18.09.17
 * Time: 22:56
 */

namespace AlexGunkel\ProjectOrganizer\AccessValidation;


use AlexGunkel\ProjectOrganizer\Domain\Model\Validation\State;

interface AcceptableInterface
{
    public function setValidationState(State $accepted): AcceptableInterface ;
    public function getValidationState() : State ;
}