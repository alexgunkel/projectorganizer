<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 29.10.17
 * Time: 23:08
 */

namespace AlexGunkel\ProjectOrganizer\Value;


class AcceptanceState
{
    /**
     * @var bool
     */
    private $accepted;

    public function __construct(bool $accepted)
    {
        $this->accepted = $accepted;
    }

    public function __toString(): string
    {
        return $this->accepted;
    }
}