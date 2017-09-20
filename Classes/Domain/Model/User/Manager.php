<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 19.09.17
 * Time: 17:43
 */

namespace AlexGunkel\ProjectOrganizer\Domain\Model\User;


class Manager
{
    private $nBeUserUid;

    public function __construct(int $uid)
    {
        $this->nBeUserUid = $uid;
    }

    public function getUid() : int
    {
        return $this->nBeUserUid;
    }
}