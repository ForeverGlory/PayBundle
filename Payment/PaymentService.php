<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\PayBundle\Payment;

use Glory\Bundle\PayBundle\Payment\Provider\ProviderInterface;
use Glory\Bundle\PayBundle\Model\PayInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of PaymentService
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class PaymentService
{

    /**
     * @var ProviderInterface[] 
     */
    protected $providers = [];

    public function __construct()
    {
        
    }

    public function addProvider(ProviderInterface $provider)
    {
        $this->providers[$provider->getName()] = $provider;
    }

    public function getProvider($name)
    {
        return $this->providers[$name];
    }

    public function setProviders(array $providers)
    {
        $this->providers = $providers;
    }

    public function getProviders()
    {
        return $this->providers;
    }

    public function getProviderNames()
    {
        $names = [];
        foreach ($this->getProviders() as $provider) {
            $names[$provider->getName()] = $provider->getName();
        }
        return $names;
    }

    /**
     * 
     * @param PayInterface $pay
     * @param type $provider
     * @return response
     */
    public function process(PayInterface $pay, $provider = null)
    {
        return $this->getProvider($provider? : $pay->getProvider())->process($pay);
    }

    /**
     * 
     * @param type $provider
     * @param Request $request
     * @return PayInterface
     */
    public function notify($provider, Request $request)
    {
        return $this->getProvider($provider)->notify($request);
    }

}
