<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 26.03.18
 * Time: 16:25
 */

namespace AlexGunkel\ProjectOrganizer\Service;


use TYPO3\CMS\Core\Log\LogManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Saltedpasswords\Salt\SaltFactory;

/**
 * Class ValidationServiceFactory
 * @package AlexGunkel\ProjectOrganizer\Service
 */
class ValidationServiceFactory
{
    /**
     * @var string
     */
    private const LOGGER_NAME = 'Project-Organizer Validation';

    /**
     * @return PasswordService
     */
    public static function buildPasswordService(): PasswordService
    {
        return new PasswordService(
            SaltFactory::getSaltingInstance(null, 'FE'),
            GeneralUtility::makeInstance(LogManager::class)->getLogger(self::LOGGER_NAME)
        );
    }
}
