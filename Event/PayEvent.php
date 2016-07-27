<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\PayBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Glory\Bundle\PayBundle\Model\PayInterface;

/**
 * Description of PayEvent
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class PayEvent extends Event
{

    /**
     * @var PayInterface 
     */
    protected $pay;

    public function __construct(PayInterface $pay)
    {
        $this->pay = $pay;
    }

    public function getPay()
    {
        return $this->pay;
    }

}
