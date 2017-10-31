<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 31.10.17
 * Time: 19:31
 */

namespace AlexGunkel\ProjectOrganizerTest\AccessValidation;


use AlexGunkel\ProjectOrganizer\AccessValidation\AcceptableInterface;
use AlexGunkel\ProjectOrganizer\AccessValidation\AcceptanceManager;
use PHPUnit\Framework\TestCase;

class AcceptanceManagerTest extends TestCase
{
    public function testAccept()
    {
        $acceptable = $this->getMockForAbstractClass(AcceptableInterface::class);
        $acceptable->method('setValidationState')->willReturn($acceptable);

        $acceptanceManager = new AcceptanceManager;
    }
}