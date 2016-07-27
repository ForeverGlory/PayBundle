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
use Glory\DoctrineManager\DoctrineManager;
use Glory\Bundle\PayBundle\Model\PayInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Description of PayController
 * 
 * @author ForeverGlory <foreverglory@qq.com>
 */
class PayController extends Controller
{

    public function centerAction(Request $request)
    {
        $payService = $this->get('glory_pay.pay_service');
        $payManager = $this->getManager();
        $pay = $payManager->create(['body' => '充值', 'type' => 'center', 'user' => $this->getUser()]);
        $form = $this->createFormBuilder($pay)
                ->add('amount', TextType::class)
                ->add('provider', ChoiceType::class, ['choices' => $payService->getProviderNames(), 'data' => 'wechat'])
                ->add('detail', TextType::class)
                ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $payManager->update($pay);
            return $this->redirectToRoute('glory_pay_process', ['id' => $pay->getId()]);
        }
        return $this->render('GloryPayBundle:Pay:center.html.twig', [
                    'form' => $form->createView()
        ]);
    }

    /**
     * 进行支付
     */
    public function processAction(Request $request, $id)
    {
        try {
            $pay = $this->getPay($id);
            $process = $this->get('glory_pay.pay_service')->process($pay);
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
        return $this->render('GloryPayBundle:Pay:process.html.twig', [
                    'order' => $pay,
                    'process' => $process
        ]);
    }

    /**
     * 支付通知
     */
    public function notifyAction(Request $request, $service)
    {
        try {
            //通知，如果失败，则
            $response = $this->get('glory_pay.pay_service')->notify($request, $service);
        } catch (\Exception $ex) {
            throw $ex;
        }
        return $response;
    }

    public function completeAction(Request $request)
    {
        
    }

    /**
     * @return PayInterface
     */
    protected function getPay($id)
    {
        return $this->getManager()->find($id);
    }

    /**
     * @return DoctrineManager
     */
    private function getManager()
    {
        return $this->get('glory_pay.pay_manager');
    }

}
