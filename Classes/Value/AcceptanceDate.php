<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 29.10.17
 * Time: 23:11
 */

namespace AlexGunkel\ProjectOrganizer\Value;


class AcceptanceDate
{
    /**
     * @var int
     */
    private $acceptanceDate;

    public function __construct(int $acceptanceDate)
    {
        $this->acceptanceDate = $acceptanceDate;
    }

    public function __toString(): string
    {
        return $this->acceptanceDate;
    }
}