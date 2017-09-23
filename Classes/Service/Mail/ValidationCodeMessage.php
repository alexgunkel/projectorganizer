<?php

namespace AlexGunkel\ProjectOrganizer\Service\Mail;

use AlexGunkel\ProjectOrganizer\Management\AccessValidation\AccessValidatableInterface;

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
     * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
     *
     * @inject
     */
    private $contentObjectRenderer;

    /**
     * @var AccessValidatableInterface
     */
    private $object;

    /**
     * @var \TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder
     */
    private $uriBuilder;

    public function setObject(AccessValidatableInterface $object) : ValidationCodeMessageInterface
    {
        $this->object = $object;

        return $this;
    }

    public function setUriBuilder(\TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder $uriBuilder) : ValidationCodeMessageInterface
    {
        $this->uriBuilder = $uriBuilder;

        return $this;
    }

    public function setTo(array $recipients): ValidationCodeMessageInterface
    {
        $this->messageObject->setTo($recipients);

        return $this;
    }

    public function send() : bool
    {
        return $this->generateMessageBody($this->generateLink())
            ->sendMessage();
    }

    private function generateLink()
    {
        return $this->uriBuilder
            ->reset()
            ->setCreateAbsoluteUri(true)
            ->uriFor(
                'validateByValidationCode',
                [
                    'validationCode' => $this->validator->generateValidationCode($this->object),
                    'projectUid' => (string) $this->object->getUid(),
                ],
                'Validator',
                null,
                'edit_projects'
            );
    }

    private function generateMessageBody(string $link) : ValidationCodeMessage
    {

        $this->messageObject->setBody(
            'Uid: ' . $this->object->getUid() . "\n"
            . 'Title: ' . $this->object->getTitle() . "\n"
            . 'Code: ' . $this->validator->generateValidationCode($this->object) . "\n"
            . 'Link: ' . $link
        );

        return $this;
    }

    private function sendMessage() : bool
    {
        $this->messageObject->send();
        return $this->messageObject->isSent();
    }
}