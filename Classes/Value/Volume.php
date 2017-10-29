<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 29.10.17
 * Time: 22:45
 */

namespace AlexGunkel\ProjectOrganizer\Value;


class Volume
{
    /**
     * @var int
     */
    private $volume;

    public function __construct(int $volume)
    {
        $this->volume = $volume;
    }

    public function __toString(): string
    {
        return $this->volume;
    }
}