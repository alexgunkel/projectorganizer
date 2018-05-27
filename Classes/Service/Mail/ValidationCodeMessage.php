<?php

namespace AlexGunkel\ProjectOrganizer\Service\Mail;


use AlexGunkel\ProjectOrganizer\AccessValidation\AccessValidator;
use AlexGunkel\ProjectOrganizer\AccessValidation\AccessValidatorInterface;
use AlexGunkel\ProjectOrganizer\Domain\Model\Project;
use AlexGunkel\ProjectOrganizer\Service\PasswordService;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;

/**
 * Class ValidationCodeMessage
 * @package AlexGunkel\ProjectOrganizer\Service\Mail
 */
class ValidationCodeMessage
{
    /**
     * @var \TYPO3\CMS\Core\Mail\MailMessage
     */
    private $messageObject;

    /**
     * @var Project
     */
    private $object;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var \TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder
     */
    private $uriBuilder;

    /**
     * ValidationCodeMessage constructor.
     * @param UriBuilder $uriBuilder
     * @param PasswordService|null $accessValidator
     * @param MailMessage|null $mailMessage
     * @param LoggerInterface|null $logger
     */
    public function __construct(
        UriBuilder      $uriBuilder,
        PasswordService $passwordService = null,
        MailMessage     $mailMessage = null,
        LoggerInterface $logger = null
    ) {
        $this->messageObject = $mailMessage ?: new MailMessage;
        $this->passwordService     = $passwordService ?: new AccessValidator;
        $this->uriBuilder    = $uriBuilder;
        $this->logger        = $logger ?: new NullLogger;
    }

    /**
     * @param Project $object
     * @return ValidationCodeMessage
     */
    public function setObject(Project $object) : ValidationCodeMessage
    {
        $this->object = $object;

        return $this;
    }

    /**
     * @param array $recipients
     * @return ValidationCodeMessage
     */
    public function setTo(array $recipients): ValidationCodeMessage
    {
        $this->messageObject->setTo($recipients);

        return $this;
    }

    /**
     * @return bool
     */
    public function send() : bool
    {
        return $this->generateMessageBody($this->generateLink())
            ->sendMessage();
    }

    /**
     * @return string
     */
    private function generateLink()
    {
        return $this->uriBuilder
            ->reset()
            ->setCreateAbsoluteUri(true)
            ->uriFor(
                'validateByValidationCode',
                [
                    'validationCode' => $this->object->getPassword(),
                    'projectUid' => (string) $this->object->getUid(),
                ],
                'Validator',
                null
            );
    }

    /**
     * @param string $link
     * @return ValidationCodeMessage
     */
    private function generateMessageBody(string $link) : ValidationCodeMessage
    {
        $this->messageObject->setBody(
            'Uid: ' . $this->object->getUid() . "\n"
            . 'Title: ' . $this->object->getTitle() . "\n"
            . 'Code: ' . $this->object->getPassword() . "\n"
            . 'Link: ' . $link . "\n"
            . 'E-Mail: ' . $this->object->getContactEmail()
        );

        return $this;
    }

    /**
     * @return bool
     */
    private function sendMessage() : bool
    {
        $this->messageObject->send();

        $this->logger->debug(
            'Sending new message to '
            . implode(', ', $this->messageObject->getTo())
            . ': '
            . $this->messageObject->getBody()
        );

        return $this->messageObject->isSent();
    }
}
