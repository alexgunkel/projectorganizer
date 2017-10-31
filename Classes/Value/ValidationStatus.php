<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 31.10.17
 * Time: 14:57
 */

namespace AlexGunkel\ProjectOrganizer\Value;


class ValidationStatus
{
    /**
     * @var int
     */
    private $status;

    public const OPEN     = 0;
    public const ACCEPTED = 1;
    public const REJECTED = -1;

    public function __construct(int $status = self::OPEN)
    {
        $this->status = $status;
    }

    public function isValidated(): bool
    {
        return self::ACCEPTED === $this->status;
    }
}