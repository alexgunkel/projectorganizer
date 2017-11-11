<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 25.09.17
 * Time: 22:39
 */

namespace AlexGunkel\ProjectOrganizer\Domain\Model\User;


class DummyManager extends Manager
{
    public function __construct()
    {
    }

    public function getUid() : int
    {
        return 0;
    }

    public function getUsername() : string 
    {
        return 'unknown';
    }

    public function __toString(): string
    {
        return get_class($this) . ':0';
    }
}