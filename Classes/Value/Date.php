<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 30.10.17
 * Time: 18:21
 */

namespace AlexGunkel\ProjectOrganizer\Value;


class Date
{
    /**
     * @var int
     */
    private $date;

    public function __construct(int $date)
    {
        $this->date = $date;
    }

    public function __toString(): string
    {
        return $this->date;
    }
}