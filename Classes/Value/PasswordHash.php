<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 26.03.18
 * Time: 15:28
 */

namespace AlexGunkel\ProjectOrganizer\Value;


/**
 * Class PasswordHash
 * @package AlexGunkel\ProjectOrganizer\Value
 */
class PasswordHash
{
    /**
     * @var string
     */
    private $passwordHash;

    /**
     * PasswordHash constructor.
     * @param string $passwordHash
     */
    public function __construct(string $passwordHash)
    {
        $this->passwordHash = $passwordHash;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->passwordHash;
    }
}
