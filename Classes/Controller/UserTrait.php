<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 07.07.18
 * Time: 15:00
 */

namespace AlexGunkel\ProjectOrganizer\Controller;


use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;

trait UserTrait
{


    /**
     * @return FrontendUserAuthentication
     */
    private function getUserAuthentication(): FrontendUserAuthentication
    {
        global $GLOBALS;
        return $GLOBALS['TSFE']->fe_user;
    }


    /**
     * @return BackendUserAuthentication
     */
    private function getBeUserAuthentication(): BackendUserAuthentication
    {
        global $BE_USER;
        return $BE_USER;
    }
}