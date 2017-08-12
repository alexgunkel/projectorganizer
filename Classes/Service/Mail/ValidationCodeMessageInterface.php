<?php

namespace AlexGunkel\ProjectOrganizer\Service\Mail;

use AlexGunkel\ProjectOrganizer\Management\AccessValidation\AccessValidatableInterface;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;

interface ValidationCodeMessageInterface
{
    public function setTo(array $recipients) : ValidationCodeMessageInterface ;
    public function setObject(AccessValidatableInterface $object) : ValidationCodeMessageInterface;
    public function setUriBuilder(UriBuilder $uriBuilder) : ValidationCodeMessageInterface;
    public function send() : bool ;
}