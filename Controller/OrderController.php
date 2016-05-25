<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\PayBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Glory\Bundle\PayBundle\Payment\Provider\ProviderInterface;
use Glory\Bundle\PayBundle\Model\OrderInterface;

/**
 * Description of OrderController
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class OrderController extends Controller
{

    /**
     * 进行支付
     */
    public function processAction(Request $request, $service, $id)
    {
        $provider = $this->getPayProvider($service);
        try {
            $order = $this->getOrder($id);
            $process = $provider->process($order);
        } catch (\Exception $ex) {
            //todo: 已支付、错误等等通知
            throw $ex;
        }
        if (!$process) {
            throw $this->createNotFoundException('No service.');
        }
        //用于直接跳转或自定义页面等
        if ($process instanceof Response) {
            return $process;
        }
        return $this->render('GloryPayBundle:Order:process.html.twig', [
                    'provider' => $provider,
                    'order' => $order,
                    'process' => $process
        ]);
    }

    /**
     * 支付通知
     */
    public function notifyAction(Request $request, $service)
    {
        $provider = $this->getPayProvider($service);
        try {
            $order = $provider->getOrderSn($request);
            $response = $provider->notify($order);
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $response;
    }

    /**
     * @param type $service
     * @return ProviderInterface
     */
    protected function getPayProvider($service)
    {
        $ids = $this->get('glory_pay.pay_manager')->getPayProviders();
        $provider = $this->get($ids[$service]);
        return $provider;
    }

    /**
     * @return OrderInterface
     */
    protected function getOrder($id)
    {
        $payManager = $this->get('glory_pay.pay_manager');
        $order = $payManager->getOrder($id);
        return $order;
    }

}
