<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\PayBundle\Entity;

use Glory\Bundle\PayBundle\Model\Pay as BasePay;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Pay Entity
 * 
 * @ORM\Entity
 * @ORM\Table("pay")
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class Pay extends BasePay
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $sn;

    /**
     * @ORM\Column(type="string")
     */
    protected $detail;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $body;

    /**
     * @ORM\Column(type="float", precision=10, scale=2)
     */
    protected $amount;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $type;

    /**
     * @ORM\Column(type="string")
     */
    protected $provider;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $status = 'unpaid';

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $createdTime;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $paidTime;

    /**
     * @ORM\Column(type="array")
     */
    protected $data = [];

    /**
     * @var user
     * 
     * @ORM\ManyToOne(targetEntity="Symfony\Component\Security\Core\User\UserInterface")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    public function __construct($sn = null)
    {
        $sn = $sn? : date('YmdHis') . mt_rand(1000, 9999);
        $this->setSn($sn);
        $this->setCreatedTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setSn($sn)
    {
        $this->sn = $sn;
        return $this;
    }

    public function getSn()
    {
        return $this->sn;
    }

    public function setDetail($detail)
    {
        $this->detail = $detail;
        return $this;
    }

    public function getDetail()
    {
        return $this->detail;
    }

    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setProvider($provider)
    {
        $this->provider = $provider;
        return $this;
    }

    public function getProvider()
    {
        return $this->provider;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setCreatedTime(\DateTime $createdTime = null)
    {
        $this->createdTime = $createdTime? : new \DateTime();
        return $this;
    }

    public function getCreatedTime()
    {
        return $this->createdTime;
    }

    public function setPaidTime(\DateTime $paidTime = null)
    {
        $this->paidTime = $paidTime? : new \DateTime();
        return $this;
    }

    public function getPaidTime()
    {
        return $this->paidTime = null;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setUser(UserInterface $user)
    {
        $this->user = $user;
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

}
