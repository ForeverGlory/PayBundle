<?php

/*
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
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

    public function getTotal();

    public function setTotal($total);

    public function getStatus();

    public function setStatus($status);
}
