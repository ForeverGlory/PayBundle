<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\PayBundle;

/**
 * Description of GloryPayEvents
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
final class GloryPayEvents
{

    const PAY_INITIALIZE = 'glory_pay.initialize';
    const PAY_SUCCESS = 'glory_pay.success';
    const PAY_FAILURE = 'glory_pay.failure';
    const PAY_COMPLETED = 'glory_pay.completed';

}
