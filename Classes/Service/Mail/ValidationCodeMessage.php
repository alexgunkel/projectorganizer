<?php

namespace AlexGunkel\ProjectOrganizer\Service\Mail;


use AlexGunkel\ProjectOrganizer\AccessValidation\AccessValidator;
use AlexGunkel\ProjectOrganizer\AccessValidation\AccessValidatorInterface;
use AlexGunkel\ProjectOrganizer\Domain\Model\Project;
use AlexGunkel\ProjectOrganizer\Domain\Model\Validatable;
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
     * @var Validatable
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
     * @var string
     */
    private $template;

    private $controller;

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
        LoggerInterface $logger = null,
        ?string $controllerName
    ) {
        $this->messageObject = $mailMessage ?: new MailMessage;
        $this->passwordService     = $passwordService ?: new AccessValidator;
        $this->uriBuilder    = $uriBuilder;
        $this->logger        = $logger ?: new NullLogger;
        $this->controller = $controllerName;
    }

    /**
     * @return string
     */
    public function getTemplate(): ?string
    {
        return $this->template;
    }

    /**
     * @param string $template
     */
    public function setTemplate(string $template)
    {
        $this->template = $template;
    }

    /**
     * @param Validatable $object
     * @return ValidationCodeMessage
     */
    public function setObject(Validatable $object) : ValidationCodeMessage
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
                    'itemUid' => (string) $this->object->getUid(),
                ],
                $this->controller ?? 'Validator',
                null
            );
    }

    /**
     * @param string $link
     * @return ValidationCodeMessage
     */
    private function generateMessageBody(string $link) : ValidationCodeMessage
    {
        if (null !== $this->template && file_exists($this->template)) {
            ob_start();
            require $this->template;
            $result = ob_get_clean();

            $this->messageObject->setBody($result);
            return $this;
        }

        $properties = get_class_methods($this->object);
        $body = '';
        foreach ($properties as $property) {
            if (substr($property, 0, 3) === 'get'
                && !empty($this->object->{$property}())
                && (is_string($this->object->{$property}())
                    || is_numeric($this->object->{$property}())
                    || is_object( $this->object->{$property}() ) && method_exists( $this->object->{$property}(), '__toString' ))
            ) {
                $body .= substr($property, 3) . ': ' . $this->object->{$property}() . PHP_EOL;
            }
        }
        $this->messageObject->setBody(
            'Uid: ' . $this->object->getUid() . "\n"
            . 'Title: ' . $this->object->getTitle() . "\n"
            . 'Code: ' . $this->object->getPassword() . "\n"
            . 'Link: ' . $link . "\n" . $body
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
