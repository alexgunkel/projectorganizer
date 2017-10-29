<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 29.10.17
 * Time: 22:40
 */

namespace AlexGunkel\ProjectOrganizer\Value;


class Runtime
{
    /**
     * @var int
     */
    private $runtim;

    public function __construct(int $runtime)
    {
        $this->runtim = $runtime;
    }

    public function __toString(): string
    {
        return $this->runtim;
    }
}