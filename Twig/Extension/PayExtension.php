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

use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Description of PayExtension
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class PayExtension extends Twig_Extension
{

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('pay_status', array($this, 'payStatus')),
        );
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('pay_status', [$this, 'payStatus'])
        ];
    }

    /**
     * 
     */
    public function payStatus($status)
    {
        $names = ['paid' => '已支付', 'unpaid' => '未支付'];
        return $names[$status];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'glory_pay';
    }

}
