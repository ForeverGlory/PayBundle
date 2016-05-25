<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\PayBundle\Model;

/**
 * Description of Order
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class Order implements OrderInterface
{

    protected $id;
    protected $body;
    protected $detail;
    protected $amount;
    protected $status;
    protected $sn;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    public function setDetail($detail)
    {
        $this->detail = $detail;
        return $this;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getDetail()
    {
        return $this->detail;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function isPaid()
    {
        $status = ['paid', 'success'];
        return in_array($this->getStatus(), $status);
    }

    public function setSn($sn = null)
    {
        $this->sn = $sn? : date('YmdHis') . mt_rand(1000, 9999);
        return $this;
    }

    public function getSn()
    {
        return $this->sn;
    }

}
