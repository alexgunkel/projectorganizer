<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 15.01.18
 * Time: 22:23
 */

namespace AlexGunkel\ProjectOrganizer\Service;

use AlexGunkel\ProjectOrganizer\Domain\Model\Project;
use AlexGunkel\ProjectOrganizer\Domain\Model\Validatable;
use AlexGunkel\ProjectOrganizer\Value\Password;
use AlexGunkel\ProjectOrganizer\Value\PasswordHash;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Saltedpasswords\Salt\SaltInterface;

/**
 * Class PasswordService
 * @package AlexGunkel\ProjectOrganizer\Service
 */
class PasswordService implements SingletonInterface
{
    /**
     * @var \TYPO3\CMS\Saltedpasswords\Salt\SaltInterface
     */
    private $salting;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * PasswordService constructor.
     * @param SaltInterface $salt
     * @param LoggerInterface $logger
     */
    public function __construct(SaltInterface $salt, LoggerInterface $logger)
    {
        $this->salting = $salt;
        $this->logger = $logger;
    }

    /**
     * @return Password
     */
    public function generateRandomPassword(): Password
    {
        return new Password(bin2hex(openssl_random_pseudo_bytes(20)));
    }

    /**
     * @param Password $password
     *
     * @return PasswordHash
     */
    public function getSaltedPassword(Password $password) : PasswordHash
    {
        $this->logger->debug("Generate password hash for $password");
        return new PasswordHash($this->salting->getHashedPassword($password));
    }

    /**
     * @param Project $project
     * @param Password $password
     *
     * @return bool
     */
    public function validateProject(Validatable $project, Password $password): bool
    {
        $this->logger->debug("Check password $password for project $project");
        return $this->salting->checkPassword(
            $password,
            $project->getPasswordHash()
        );
    }
}
