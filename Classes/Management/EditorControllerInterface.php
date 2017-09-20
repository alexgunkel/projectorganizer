<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 13.08.17
 * Time: 10:49
 */

namespace AlexGunkel\ProjectOrganizer\Management;


use AlexGunkel\ProjectOrganizer\AccessValidation\AcceptableInterface;

interface EditorControllerInterface
{
    public function createAction(AcceptableInterface $project = null) : void;

    /**
     * Add the given project and return project to view
     *
     * @param ManagableInterface $project
     *
     * @return void
     */
    public function submitAction(AcceptableInterface $project) : void;
}