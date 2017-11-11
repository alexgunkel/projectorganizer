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

class TestDummyManager extends TestCase
{
    public function testDummyManagerValues()
    {
        $dummy = new DummyManager;

        $this->assertEquals(
            0,
            $dummy->getUid()
        );

        $this->assertEquals(
            'unknown',
            $dummy->getUsername()
        );

        $this->assertEquals(
            DummyManager::class . ':0',
            (string) $dummy
        );

        $this->assertInstanceOf(
            Manager::class,
            $dummy
        );
    }
}