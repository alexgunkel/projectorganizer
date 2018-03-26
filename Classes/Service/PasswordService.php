<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 15.01.18
 * Time: 22:23
 */

namespace AlexGunkel\FeUseradd\Service;

use AlexGunkel\ProjectOrganizer\Domain\Model\Project;
use AlexGunkel\ProjectOrganizer\Value\Password;
use AlexGunkel\ProjectOrganizer\Value\PasswordHash;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Core\Log\LogManager;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Saltedpasswords\Salt\SaltFactory;

class PasswordService implements SingletonInterface
{
    private $salting;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct()
    {
        $this->salting = SaltFactory::getSaltingInstance(null, 'FE');
        $this->logger = GeneralUtility::makeInstance(LogManager::class)->getLogger(__CLASS__);
    }

    public function generateRandomPassword(): Password
    {
        return new Password(bin2hex(openssl_random_pseudo_bytes(20)));
    }

    /**
     * @param string $password
     * @return PasswordHash
     */
    public function getSaltedPassword(string $password, string $prefix = '') : PasswordHash
    {
        $password = $prefix . $password;
        $this->logger->debug("Generate password hash for $password");
        return new PasswordHash($this->salting->getHashedPassword($password));
    }

    /**
     * @param Project $user
     * @param string $password
     * @return bool
     */
    public function validateUser(Project $project, string $password): bool
    {
        $password = $user->getRegistrationState() . $password;
        $this->logger->debug("Check password $password for user $project");
        return $this->salting->checkPassword(
            $password,
            $project->getPassword()
        );
    }
}