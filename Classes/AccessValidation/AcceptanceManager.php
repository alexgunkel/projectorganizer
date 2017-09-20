<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 13.08.17
 * Time: 12:32
 */

namespace AlexGunkel\ProjectOrganizer\AccessValidation;

use AlexGunkel\ProjectOrganizer\Domain\Model\User\Manager;

class AcceptanceManager implements AcceptanceManagerInterface
{
    /**
     * @var \AlexGunkel\ProjectOrganizer\Domain\Repository\User\ManagerRepository
     *
     * @inject
     */
    private $managerRepository;

    public function accept(AcceptableInterface $acceptable)
    {
        $this->setAccepted($acceptable, new \DateTime());
        $this->setAcceptedBy(
            $acceptable,
            $this->managerRepository->getActiveManager()
        );
    }

    public function setAccepted(
        AcceptableInterface $acceptable,
        \DateTimeInterface $acceptanceDate
    ) : AcceptanceManagerInterface {
            $acceptable->setAccepted($acceptanceDate->getTimestamp());

            return $this;
    }

    public function getAccepted(AcceptableInterface $acceptable) : \DateTimeInterface
    {
        return (new \DateTime())->setTimestamp($acceptable->getAccepted());
    }

    public function isAccepted(AcceptableInterface $acceptable) : bool
    {
        return 0 !== $acceptable->getAccepted();
    }

    public function getAcceptedBy(AcceptableInterface $acceptable) : Manager
    {
        return new Manager($acceptable->getAcceptingManagerUid());
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