<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 14.08.17
 * Time: 21:41
 */

namespace AlexGunkel\ProjectOrganizer\Management;


use TYPO3\CMS\Extbase\Persistence\RepositoryInterface;

interface EditableRepositoryInterface extends RepositoryInterface
{
    public function getPropertyOptions() : array ;
}