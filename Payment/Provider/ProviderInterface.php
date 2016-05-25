<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\PayBundle\Payment\Provider;

use Glory\Bundle\PayBundle\Model\OrderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ProviderInterface
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
interface ProviderInterface
{
    
    public function getName();

    public function setOption($option);

    public function process(OrderInterface $order);
    
    /**
     * @return OrderInterface
     */
    public function getOrder();

    public function notifyCheck(Request $request);

    public function notify(OrderInterface $order);
}
