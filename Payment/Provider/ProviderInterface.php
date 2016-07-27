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

use Glory\Bundle\PayBundle\Model\PayInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ProviderInterface
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
interface ProviderInterface
{

    public function getName();

    public function setOption($option);

    public function process(PayInterface $pay);

    public function notify(Request $request);

    public function setPay(PayInterface $pay);
}
