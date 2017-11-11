<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 11.11.17
 * Time: 20:32
 */

namespace AlexGunkel\ProjectOrganizerTest\Domain\Model\User;

use AlexGunkel\ProjectOrganizer\Domain\Model\User\DummyManager;
use AlexGunkel\ProjectOrganizer\Domain\Model\User\Manager;
use PHPUnit\Framework\TestCase;

class TestManager extends TestCase
{
    public function testManagerValues()
    {
        $manager = (new Manager(12))
            ->setUsername('Hans Wurst');

        $this->assertEquals(
            12,
            $manager->getUid()
        );

        $this->assertEquals(
            'Hans Wurst',
            $manager->getUsername()
        );

        $this->assertEquals(
            'Hans Wurst',
            (string) $manager
        );

        $this->assertInstanceOf(
            Manager::class,
            $manager
        );
    }
}