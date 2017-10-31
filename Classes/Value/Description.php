<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 31.10.17
 * Time: 10:36
 */

namespace AlexGunkel\ProjectOrganizer\Value;


class Description
{
    private $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function __toString(): string
    {
        return $this->content;
    }
}