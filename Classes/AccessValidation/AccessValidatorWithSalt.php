<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 21.09.17
 * Time: 23:01
 */

namespace AlexGunkel\ProjectOrganizer\AccessValidation;

use AlexGunkel\ProjectOrganizer\Domain\Model\Project;
use AlexGunkel\ProjectOrganizer\Domain\Model\Validatable;

class AccessValidatorWithSalt implements AccessValidatorInterface
{
    private const SALT = 'uz/oongahthie2oobujoiPuYio+bahwu';

    public function generateValidationCode(Validatable $accessValidatable): string
    {
        return md5($accessValidatable->getTitle() . self::SALT . (string) $accessValidatable->getUid());
    }

    public function validate(Validatable $accessValidatable, string $validationCode): bool
    {
        return $this->generateValidationCode($accessValidatable) === $validationCode;
    }
}