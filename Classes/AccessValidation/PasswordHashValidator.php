<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 21.09.17
 * Time: 23:10
 */

namespace AlexGunkel\ProjectOrganizer\AccessValidation;


use AlexGunkel\ProjectOrganizer\Management\AccessValidation\AccessValidatableInterface;

class PasswordHashValidator implements AccessValidatorInterface
{
    public function generateValidationCode(AccessValidatableInterface $accessValidatable): string
    {
        return password_hash(
            $accessValidatable->getTitle()
            . $accessValidatable->getUid()
        );
    }

    public function validate(AccessValidatableInterface $accessValidatable, string $validationCode): bool
    {
        return password_verify(
            $this->generateValidationCode($accessValidatable),
            $validationCode
        );
    }
}