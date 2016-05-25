<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\PayBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\Routing\RouterInterface;
use Twig_Extension;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Twig_SimpleFunction;

/**
 * Description of PayExtension
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class PayExtension extends Twig_Extension implements ContainerAwareInterface
{

    use ContainerAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('pay', array($this, 'getPayFunction')),
        );
    }

    /**
     * 
     */
    public function payFunction($order, $service)
    {
        return '';
    }

    /**
     * Returns the router.
     *
     * @return RouterInterface
     *
     * @throws \Exception
     */
    protected function getRouter()
    {
        return $this->container->get('router');
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'glory_pay';
    }

}
