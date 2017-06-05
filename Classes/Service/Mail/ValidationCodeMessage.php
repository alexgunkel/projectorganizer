<?php

namespace AlexGunkel\ProjectOrganizer\Service\Mail;

use AlexGunkel\ProjectOrganizer\AccessValidation\AccessValidatableInterface;

class ValidationCodeMessage
    implements ValidationCodeMessageInterface
{
    /**
     * @var \TYPO3\CMS\Core\Mail\MailMessage
     *
     * @inject
     */
    private $messageObject;

    /**
     * @var \AlexGunkel\ProjectOrganizer\AccessValidation\AccessValidatorInterface
     *
     * @inject
     */
    private $validator;

    /**
     * @var AccessValidatableInterface
     */
    private $object;

    public function setObject(AccessValidatableInterface $object) : ValidationCodeMessageInterface
    {
        $this->object = $object;

        return $this;
    }

    public function setTo(array $recipients): ValidationCodeMessageInterface
    {
        $this->messageObject->setTo($recipients);

        return $this;
    }

    public function send() : bool
    {
        $this->messageObject->setBody(
            'Code: ' . $this->validator->generateValidationCode($this->object)
        );

        $this->messageObject->send();

        return $this->messageObject->isSent();
    }
}