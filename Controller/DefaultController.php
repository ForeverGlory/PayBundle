<?php

namespace Glory\Bundle\PayBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function indexAction(Request $request, $id)
    {
        $order = $this->get('glory_pay.pay_manager')->getOrder($id); 
        return $this->render('GloryPayBundle:Default:index.html.twig', array('order' => $order));
    }

}
