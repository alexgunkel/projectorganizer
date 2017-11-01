<?php
/**
 * This file is part of ProjectOrganizer.
 *
 * ProjectOrganizer is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * ProjectOrganizer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with ProjectOrganizer.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category TYPO3 Extension
 * @package  Project Organizer
 * @author   Alexander Gunkel <alexandergunkel@gmail.com>
 * @license  GPL
 * @link     http://www.gnu.org/licenses/
 */

namespace AlexGunkel\ProjectOrganizerTest\AccessValidation;

use AlexGunkel\ProjectOrganizer\Domain\Model\Project;
use AlexGunkel\ProjectOrganizer\Value\Denomination;
use PHPUnit\Framework\TestCase;

abstract class AbstractAccessValidatorTest extends TestCase
{
    /**
     * @var \AlexGunkel\ProjectOrganizer\AccessValidation\AccessValidatorInterface
     */
    protected $sut;

    /**
     * @var array
     */
    protected static $arUsedCodes = array();

    /**
     * @param int $nUid
     *
     * @dataProvider uidDataProvider
     */
    public function testCodeDiffersWithUid(int $nUid, string $title)
    {
        $project = $this->getMockBuilder(Project::class)
            ->setMethods(
                ['getUid']
            )
            ->getMock();
        $project->setTitle($title);

        $code = $this->sut->generateValidationCode($project);

        $this->assertNotContains(
            $code,
            self::$arUsedCodes
        );

        self::$arUsedCodes[] = $code;
    }

    /**
     * @param int $uid
     * @param string $crDate
     *
     * @dataProvider uidDataProvider
     * @test
     */
    public function testValidatorValidatesGeneratedCode(int $uid, string $title)
    {
        $project = $this->getMockBuilder(Project::class)
            ->setMethods(
                ['getUid']
            )
            ->getMock();
        $project->setTitle($title);

        $this->assertTrue(
            $this->sut->validate(
                $project,
                $this->sut->generateValidationCode($project)
            )
        );
    }

    public function uidDataProvider()
    {
        return array(
            array(12, 'blabla'),
            array(12, ''),
            array(11, 'Ein Titel'),
            array(0, ' '),
        );
    }
}