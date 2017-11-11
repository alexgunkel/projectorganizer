<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 11.11.17
 * Time: 20:17
 */

namespace AlexGunkel\ProjectOrganizerTest\Domain\Model;


use AlexGunkel\ProjectOrganizer\Domain\Model\Wskelement;
use PHPUnit\Framework\TestCase;

class WskElementTest extends TestCase
{
    /**
     * @test
     */
    public function anInstanceOfCanBeConstructed()
    {
        $object = new Wskelement;
        $object->setTitle('name');
        $this->assertEquals(
            'name',
            $object->getTitle()
        );
    }
}