<?php

namespace AlexGunkel\ProjectOrganizer\Service\Mail;

use AlexGunkel\ProjectOrganizer\AccessValidation\AccessValidatableInterface;

interface ValidationCodeMessageInterface
{
    public function setTo(array $recipients) : ValidationCodeMessageInterface ;
    public function setObject(AccessValidatableInterface $object) : ValidationCodeMessageInterface;
    public function send() : bool ;
}