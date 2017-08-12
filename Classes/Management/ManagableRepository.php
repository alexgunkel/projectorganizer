<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 13.08.17
 * Time: 10:22
 */

namespace AlexGunkel\ProjectOrganizer\Management;


use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\RepositoryInterface;

interface ManagableRepository extends RepositoryInterface
{
    public function findAccepted() : QueryResultInterface;
    public function findOpenRequests() : QueryResultInterface;
}