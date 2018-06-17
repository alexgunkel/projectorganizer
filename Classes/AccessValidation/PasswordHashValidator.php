<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 21.09.17
 * Time: 23:10
 */

namespace AlexGunkel\ProjectOrganizer\AccessValidation;

use AlexGunkel\ProjectOrganizer\Domain\Model\Validatable;

class PasswordHashValidator implements AccessValidatorInterface
{
    public function generateValidationCode(Validatable $accessValidatable): string
    {
        return password_hash(
            $accessValidatable->getUid(),
            PASSWORD_DEFAULT
        );
    }

    public function validate(Validatable $accessValidatable, string $validationCode): bool
    {
        return password_verify(
            $accessValidatable->getUid(),
            $validationCode
        );
    }
}