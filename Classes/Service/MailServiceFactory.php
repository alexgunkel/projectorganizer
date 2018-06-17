<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 26.03.18
 * Time: 14:10
 */

namespace AlexGunkel\ProjectOrganizer\Service;

use AlexGunkel\ProjectOrganizer\AccessValidation\AccessValidatorInterface;
use AlexGunkel\ProjectOrganizer\Domain\Model\Validatable;
use AlexGunkel\ProjectOrganizer\Service\Mail\DeliveryAgent;
use AlexGunkel\ProjectOrganizer\Service\Mail\ValidationCodeMessage;
use Psr\Log\NullLogger;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;

class MailServiceFactory
{
    /**
     * @param UriBuilder $uriBuilder
     * @param AccessValidatorInterface $accessValidator
     * @param MailMessage $mailMessage
     *
     * @return ValidationCodeMessage
     */
    public static function buildValidationCodeMessage(
        Validatable $project,
        UriBuilder $uriBuilder,
        AccessValidatorInterface $accessValidator = null,
        MailMessage $mailMessage = null,
        string $controllerName = null
    ): ValidationCodeMessage {
        $message = new ValidationCodeMessage(
            $uriBuilder,
            $accessValidator ?: ValidationServiceFactory::buildPasswordService(),
            $mailMessage ?: new MailMessage,
            new NullLogger(),
            $controllerName

        );

        return $message->setObject($project);
    }

    /**
     * @param string $receivers
     *
     * @return DeliveryAgent
     */
    public static function buildDeliveryAgent(string $receivers = null): DeliveryAgent
    {
        $agent = new DeliveryAgent;
        $receiverList = explode(',', $receivers);
        array_walk($receiverList, function(&$value, $key) {
            $value = trim($value);
        });
        foreach ($receiverList as $receiver) {
            $agent->addRecipient($receiver);
        }
        
        return $agent;
    }
}
