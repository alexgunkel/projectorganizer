<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 26.03.18
 * Time: 15:27
 */

namespace AlexGunkel\ProjectOrganizer\Value;


/**
 * Class Password
 * @package AlexGunkel\ProjectOrganizer\Value
 */
class Password
{
    /**
     * @var string
     */
    private $password;

    /**
     * Password constructor.
     * @param string $password
     */
    public function __construct(string $password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->password;
    }
}