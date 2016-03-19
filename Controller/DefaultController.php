<?php

namespace Glory\Bundle\PayBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GloryPayBundle:Default:index.html.twig', array('name' => $name));
    }
}
