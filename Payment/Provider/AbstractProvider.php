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

use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Glory\Bundle\PayBundle\Model\PayInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of AbstractProvider
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
abstract class AbstractProvider implements ProviderInterface
{

    use ContainerAwareTrait;

    protected $option;

    /**
     * @var PayInterface 
     */
    protected $pay;

    public function setOption($option = [])
    {
        $this->option = $option;
        return $this;
    }

    public function notify(Request $request)
    {
        throw new Exception('');
    }

    public function setPay(PayInterface $pay)
    {
        $this->pay = $pay;
        return $this;
    }

    public function getPay()
    {
        return $this->pay;
    }

    final protected function getNotifyUrl()
    {
        return $this->container->get('router')->generate('glory_pay_notify', ['service' => $this->getName()], true);
    }

}
