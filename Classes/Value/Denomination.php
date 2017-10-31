<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 30.10.17
 * Time: 18:29
 */

namespace AlexGunkel\ProjectOrganizer\Value;


class Denomination
{
    private $denomination;

    public function __construct(string $denomination)
    {
        $this->denomination = $denomination;
    }

    public function __toString(): string
    {
        return $this->denomination;
    }
}