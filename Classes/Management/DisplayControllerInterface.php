<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 13.08.17
 * Time: 10:45
 */

namespace AlexGunkel\ProjectOrganizer\Management;


interface DisplayControllerInterface
{
    public function listAction() : void;
    public function detailAction() : void;
}