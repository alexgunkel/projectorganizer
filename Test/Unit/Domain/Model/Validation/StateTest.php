<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 31.10.17
 * Time: 14:54
 */

namespace AlexGunkel\ProjectOrganizerTest\Domain\Model\Validation;


use AlexGunkel\ProjectOrganizer\Domain\Model\Validation\State;
use AlexGunkel\ProjectOrganizer\Value\AcceptanceDate;
use AlexGunkel\ProjectOrganizer\Value\ValidationStatus;
use PHPUnit\Framework\TestCase;

class StateTest extends TestCase
{
    /**
     * @param int|null $status
     * @param bool $result
     *
     * @dataProvider statusProvider
     */
    public function testStatus(int $status = null, bool $result = false): void
    {
        $validation = new State;
        $validation->setStatus($status);

        $this->assertInstanceOf(
            ValidationStatus::class,
            $validation->getStatus()
        );

        $this->assertSame(
            $result,
            $validation->isAccepted()
        );
    }

    public function statusProvider(): array
    {
        return [
            [
                ValidationStatus::OPEN,
                false,
            ],
            [
                ValidationStatus::ACCEPTED,
                true,
            ],
            [
                ValidationStatus::REJECTED,
                false
            ],
        ];
    }

    public function testDate()
    {
        $validation = new State;
        $validation->setAcceptanceDate(0);

        $this->assertInstanceOf(
            AcceptanceDate::class,
            $validation->getAcceptanceDate()
        );
    }
}