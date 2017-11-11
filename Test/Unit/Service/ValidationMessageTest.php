<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 11.11.17
 * Time: 14:05
 */

namespace AlexGunkel\ProjectOrganizerTest\Service;


use AlexGunkel\ProjectOrganizer\AccessValidation\AccessValidatorInterface;
use AlexGunkel\ProjectOrganizer\Domain\Model\Project;
use AlexGunkel\ProjectOrganizer\Service\Mail\DeliveryAgent;
use AlexGunkel\ProjectOrganizer\Service\Mail\ValidationCodeMessage;
use PHPUnit\Framework\TestCase;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;

class ValidationMessageTest extends TestCase
{
    /**
     * @param string $receiver
     * @param string $body
     * @param bool $isSent
     *
     * @dataProvider dataForMessageTest
     */
    public function testGenerateAndSendMessage(string $receiver, string $url, string $body, bool $isSent)
    {
        $mailObjectMock = $this->getMockBuilder(MailMessage::class)
            ->setMethods(
                [
                    'send',
                    'isSent',
                    'setBody',
                    'setTo',
                ]
            )
            ->getMock();
        $mailObjectMock->expects($this->once())
            ->method('setTo')
            ->with(
                [$receiver]
            );
        $mailObjectMock->expects($this->once())
            ->method('setBody')
            ->with($body);
        $mailObjectMock->expects($this->once())
            ->method('send');
        $mailObjectMock->expects($this->any())
            ->method('isSent')
            ->willReturn($isSent);
        $accessValidatorMock = $this->getMockForAbstractClass(AccessValidatorInterface::class);
        $uriBuilderMock = $this->getMockBuilder(UriBuilder::class)
            ->setMethods(
                [
                    'uriFor',
                    'reset',
                    'setCreateAbsoluteUri'
                ]
            )
            ->getMock();
        $uriBuilderMock->expects($this->any())
            ->method('reset')
            ->willReturn($uriBuilderMock);
        $uriBuilderMock->expects($this->any())
            ->method('setCreateAbsoluteUri')
            ->willReturn($uriBuilderMock);
        $uriBuilderMock->expects($this->any())
            ->method('uriFor')
            ->willReturn($url);

        $message = new ValidationCodeMessage(
            $mailObjectMock,
            $accessValidatorMock,
            $uriBuilderMock
        );
        $agent = new DeliveryAgent;

        $agent->addRecipient($receiver)
            ->sendMessage(
                $message->setObject(new Project())
            );
    }

    public function dataForMessageTest()
    {
        return [
            [
                'a@b.de',
                'test',
                'Uid: ' . "\n"
                . 'Title: ' . "\n"
                . 'Code: ' . "\n"
                . 'Link: test',
                true
            ],
        ];
    }
}