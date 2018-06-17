<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 10.06.18
 * Time: 15:43
 */

namespace AlexGunkel\ProjectOrganizer\Domain\Model;


use AlexGunkel\ProjectOrganizer\Value\Password;

interface Validatable
{
    public function getUid();
    public function getPassword(): ?Password;
    public function getTitle(): string;
    public function getValidationState(): int;
    public function setValidationState(int $state);
}
