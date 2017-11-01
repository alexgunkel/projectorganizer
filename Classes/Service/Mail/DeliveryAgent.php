<?php

namespace AlexGunkel\ProjectOrganizer\Service\Mail;

class DeliveryAgent
{
    private $recipients = array();

    public function addRecipient(string $recipient) : DeliveryAgent
    {
        $this->recipients[] = $recipient;

        return $this;
    }

    public function sendMessage(ValidationCodeMessage $message) : bool
    {
        return $message->setTo($this->recipients)
            ->send();
    }
}