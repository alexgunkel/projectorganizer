<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 13.08.17
 * Time: 10:47
 */

namespace AlexGunkel\ProjectOrganizer\Management;


interface ManagerControllerInterface
{

    public function listOpenRequestsAction() : void;
    public function detailAction() : void;
    public function validateAction() : void;
    public function validateByValidationCodeAction() : void;
}