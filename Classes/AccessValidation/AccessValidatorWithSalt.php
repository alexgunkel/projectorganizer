<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 21.09.17
 * Time: 23:01
 */

namespace AlexGunkel\ProjectOrganizer\AccessValidation;


use AlexGunkel\ProjectOrganizer\Management\AccessValidation\AccessValidatableInterface;

class AccessValidatorWithSalt implements AccessValidatorInterface
{
    private const SALT = 'uz/oongahthie2oobujoiPuYio+bahwu';

    public function generateValidationCode(AccessValidatableInterface $accessValidatable): string
    {
        return md5($accessValidatable->getTitle() . self::SALT . (string) $accessValidatable->getUid());
    }

    public function validate(AccessValidatableInterface $accessValidatable, string $validationCode): bool
    {
        return $this->generateValidationCode($accessValidatable) === $validationCode;
    }
}