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
    public function createOrder($attr = [])
    {
        $class = $this->getOrderClass();
        $order = new $class();
        $order->setId($attr['id']);
        if (!empty($attr['body'])) {
            $order->setBody($attr['body']);
        }
        if (!empty($attr['detail'])) {
            $order->setDetail($attr['detail']);
        }
        if (!empty($attr['amount'])) {
            $order->setAmount(floatval($attr['amount']));
        }
        $order->setSn();
        return $order;
    }

    /**
     * @return OrderInterface
     */
    public function getOrder($id)
    {
        $respository = $this->getOrderRespository();
        return $respository->find($id);
    }

    /**
     * @return OrderInterface
     */
    public function getOrderBySn($sn)
    {
        $respository = $this->getOrderRespository();
        return $respository->findOneBy(['sn' => $sn]);
    }

    /**
     * update Order
     */
    public function updateOrder(OrderInterface $order, $isFlush = true)
    {
        $em = $this->getDoctrineManager();
        $em->persist($order);
        if ($isFlush) {
            $em->flush();
        }
    }

    public function getPayProviders()
    {
        //todo: test
        $providers = ['wechat' => 'glory_wechat.pay_provider', 'alipay' => ''];
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

    protected function getDoctrine()
    {
        return $this->container->get('doctrine');
    }

    protected function getDoctrineManager()
    {
        return $this->getDoctrine()->getManager();
    }

    protected function getOrderRespository()
    {
        return $this->getDoctrine()->getRespository($this->getOrderClass());
    }

}
