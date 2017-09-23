<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 19.09.17
 * Time: 17:43
 */

namespace AlexGunkel\ProjectOrganizer\Domain\Model\User;


use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;

class Manager extends AbstractDomainObject
{
    protected $nBeUserUid = 0;

    /**
     * @var string
     */
    protected $username;

    public function __construct(int $uid)
    {
        $this->nBeUserUid = $uid ?: 0;
    }

    public function getUid() : int
    {
        return $this->nBeUserUid;
    }

    public function getUsername() : string
    {
        return $this->username;
    }
}