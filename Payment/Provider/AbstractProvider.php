<?php

/*
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 */

namespace Glory\Bundle\PayBundle\Payment\Provider;

use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Description of AbstractProvider
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
abstract class AbstractProvider implements ProviderInterface
{

    use ContainerAwareTrait;

    protected $option;

    public function setOption($option = [])
    {
        $this->option = $option;
        return $this;
    }

    protected function getNotifyUrl()
    {
        return $this->container->get('router')->generate('glory_pay_notify', ['service' => $this->getName()], true);
    }

}
