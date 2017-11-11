<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 11.11.17
 * Time: 20:17
 */

namespace AlexGunkel\ProjectOrganizerTest\Domain\Model;


use AlexGunkel\ProjectOrganizer\Domain\Model\Topic;
use PHPUnit\Framework\TestCase;

class TopicTest extends TestCase
{
    /**
     * @test
     */
    public function anInstanceOfCanBeConstructed()
    {
        $object = new Topic;
        $object->setTitle('name');
        $this->assertEquals(
            'name',
            $object->getTitle()
        );
    }
}