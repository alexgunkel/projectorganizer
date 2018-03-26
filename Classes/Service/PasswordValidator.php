<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 04.02.18
 * Time: 22:11
 */

namespace AlexGunkel\FeUseradd\Validator;

use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;

class PasswordValidator extends AbstractValidator
{

    public function isValid($value)
    {
        try {
            $value->check();
        } catch (\Exception $exception) {
            $this->addError(
                $this->translateErrorMessage(
                    'setPassword.stringsNotEqual',
                    'project_organizer'
                ) ?: $exception->getMessage(),
                1517779179
            );
        }
    }
}