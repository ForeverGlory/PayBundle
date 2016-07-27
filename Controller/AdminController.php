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

/**
 * Description of AdminController
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class AdminController extends Controller
{

    public function indexAction(Request $request)
    {
        $manager = $this->get('glory_pay.pay_manager');
        $sql = 'select pay from ' . $manager->getClass() . ' pay';
        $query = $manager->getManager()->createQuery($sql);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $request->query->getInt('page', 1), 20
        );

        return $this->render('GloryPayBundle:Admin:index.html.twig', array(
                    'pagination' => $pagination
        ));
    }

}
