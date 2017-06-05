<?php

namespace AlexGunkel\ProjectOrganizer\Service\Mail;

interface DeliveryAgentInterface
{
    public function addRecipient(string $recipient) : DeliveryAgentInterface;
    public function sendMessage(ValidationCodeMessageInterface $message) : bool ;
}