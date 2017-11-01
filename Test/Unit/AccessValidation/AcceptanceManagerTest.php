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
use AlexGunkel\ProjectOrganizer\Domain\Model\Project;
use PHPUnit\Framework\TestCase;

class AcceptanceManagerTest extends TestCase
{
    public function testAccept()
    {
        $acceptable = new Project;

        $acceptanceManager = new AcceptanceManager;
        $acceptanceManager->accept($acceptable);

        $this->assertTrue($acceptanceManager->validate($acceptable));
    }

    public function testRefuse()
    {
        $acceptable = new Project;

        $acceptanceManager = new AcceptanceManager;
        $acceptanceManager->refuse($acceptable);

        $this->assertFalse($acceptanceManager->validate($acceptable));
    }

    public function testNeverAcceptNewProjects()
    {
        $acceptable = new Project;

        $acceptanceManager = new AcceptanceManager;

        $this->assertFalse($acceptanceManager->validate($acceptable));
    }

    public function testInitialize()
    {
        $acceptable = new Project;

        $acceptanceManager = new AcceptanceManager;
        $acceptanceManager->initializeAsNotYetAccepted($acceptable);

        $this->assertFalse($acceptanceManager->validate($acceptable));
    }
}