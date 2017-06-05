<?php

namespace AlexGunkel\ProjectOrganizer\Service\Mail;

class DeliveryAgent
    implements DeliveryAgentInterface
{
    private $recipients = array();

    public function addRecipient(string $recipient) : DeliveryAgentInterface
    {
        $this->recipients[] = $recipient;

        return $this;
    }

    public function sendMessage(ValidationCodeMessageInterface $message) : bool
    {
        return $message->setTo($this->recipients)
            ->send();
    }
}