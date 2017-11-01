<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 21.09.17
 * Time: 23:10
 */

namespace AlexGunkel\ProjectOrganizer\AccessValidation;

use AlexGunkel\ProjectOrganizer\Domain\Model\Project;

class PasswordHashValidator implements AccessValidatorInterface
{
    public function generateValidationCode(Project $accessValidatable): string
    {
        return password_hash(
            $accessValidatable->getUid(),
            PASSWORD_DEFAULT
        );
    }

    public function validate(Project $accessValidatable, string $validationCode): bool
    {
        return password_verify(
            $accessValidatable->getUid(),
            $validationCode
        );
    }
}