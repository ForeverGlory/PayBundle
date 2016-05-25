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
 * Description of OrderInterface
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
interface OrderInterface
{

    public function getId();

    public function setId($id);

    public function getBody();

    public function setBody($body);

    public function getDetail();

    public function setDetail($detail);

    public function getAmount();

    public function setAmount($amount);

    public function getStatus();

    public function setStatus($status);

    public function isPaid();

    public function getSn();

    public function setSn($sn);
}
