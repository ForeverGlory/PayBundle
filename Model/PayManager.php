<?php

/*
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 */

namespace Glory\Bundle\PayBundle\Model;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Glory\Bundle\PayBundle\Model\OrderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of PayManager
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class PayManager
{

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * 
     * @return OrderInterface
     */
    public function createOrder($attr)
    {
        $class = $this->getOrderClass();
        $order = new $class();
        $order->setId($attr['id']);
        $order->setBody($attr['body']);
        $order->setDetail($attr['detail']);
        $order->setAmount($attr['amount']);
        return $order;
    }

    /**
     * 
     * @return OrderInterface
     */
    public function getOrder($id)
    {
        $attr = [
            'id' => $id
        ];
        $order = $this->createOrder($attr);
        $order->setId($id);
        return $order;
    }

    public function getPayProviders()
    {
        $providers = ['wechat' => '', 'alipay' => ''];
        return $providers;
    }

    public function pay(Response $response = null)
    {
        
    }

    public function notify(Request $request)
    {
        
    }

    protected function getOrderClass()
    {
        return 'Glory\\Bundle\\PayBundle\\Entity\\Order';
    }

}
