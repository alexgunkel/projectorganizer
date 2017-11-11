<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 19.09.17
 * Time: 17:48
 */

namespace AlexGunkel\ProjectOrganizer\Domain\Repository\User;

use AlexGunkel\ProjectOrganizer\Domain\Model\User\Manager;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;

/**
 * Class ManagerRepository
 * @package AlexGunkel\ProjectOrganizer\Domain\Repository\User
 *
 * @codeCoverageIgnore
 */
class ManagerRepository
{
    public function getActiveManager() : Manager
    {
        return new Manager(
            $this->getBackendUser()->user['uid']
        );
    }


    /**
     * Returns the backend user
     *
     * @return BackendUserAuthentication
     */
    private function getBackendUser() : BackendUserAuthentication
    {
        global $BE_USER;

        return $BE_USER;
    }
}