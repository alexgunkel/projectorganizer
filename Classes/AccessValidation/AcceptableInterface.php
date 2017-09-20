<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 18.09.17
 * Time: 22:56
 */

namespace AlexGunkel\ProjectOrganizer\AccessValidation;


interface AcceptableInterface
{
    public function setAccepted(int $accepted);
    public function getAccepted() : int ;
    public function setAcceptingManagerUid(int $managerUid);
    public function getAcceptingManagerUid() : int ;
}