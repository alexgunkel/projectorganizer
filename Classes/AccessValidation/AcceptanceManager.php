<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 13.08.17
 * Time: 12:32
 */

namespace AlexGunkel\ProjectOrganizer\AccessValidation;

use AlexGunkel\ProjectOrganizer\Domain\Model\User\Manager;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class AcceptanceManager implements AcceptanceManagerInterface
{
    /**
     * @var \AlexGunkel\ProjectOrganizer\Domain\Repository\User\ManagerRepository
     *
     * @inject
     */
    private $managerRepository;

    public function accept(AcceptableInterface $acceptable) : AcceptanceManagerInterface
    {
        $this->setAccepted($acceptable, new \DateTime());
        $this->setAcceptedBy(
            $acceptable,
            $this->managerRepository->getActiveManager()
        );

        return $this;
    }

    public function refuse(AcceptableInterface $acceptable): AcceptanceManagerInterface
    {
        $acceptable->setAccepted(-1);
        $this->setAcceptedBy(
            $acceptable,
            $this->managerRepository->getActiveManager()
        );

        return $this;
    }

    private function setAccepted(
        AcceptableInterface $acceptable,
        \DateTimeInterface $acceptanceDate
    ) : AcceptanceManagerInterface {
            $acceptable->setAccepted($acceptanceDate->getTimestamp());

            return $this;
    }

    public function setAcceptedBy(AcceptableInterface $acceptable, Manager $accepter) : AcceptanceManagerInterface
    {
        $acceptable->setAcceptingManagerUid($accepter->getUid());

        return $this;
    }

    public function initializeAsNotYetAccepted(AcceptableInterface $acceptable) : AcceptanceManagerInterface
    {
        $acceptable->setAccepted(0);
        $acceptable->setAcceptingManagerUid(0);

        return $this;
    }
}