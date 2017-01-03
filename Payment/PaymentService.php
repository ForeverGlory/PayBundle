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
use Glory\Bundle\PayBundle\GloryPayEvents;
use Glory\Bundle\PayBundle\Event\PayEvent;
use Glory\DoctrineManager\DoctrineManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Description of PaymentService
 *
 * @author ForeverGlory <foreverglory@qq.com>
 */
class PaymentService
{

    /**
     * @var DoctrineManager 
     */
    protected $doctrineManager;

    /**
     * @var EventDispatcherInterface 
     */
    protected $dispatcher;

    /**
     * @var ProviderInterface[] 
     */
    protected $providers = [];

    public function __construct(DoctrineManager $doctrineManager, EventDispatcherInterface $dispatcher)
    {
        $this->doctrineManager = $doctrineManager;
        $this->dispatcher = $dispatcher;
    }

    public function addProvider($name, ProviderInterface $provider)
    {
        $this->providers[$name] = $provider;
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
        foreach ($this->getProviders() as $name => $provider) {
            $names[$name] = $provider->getName();
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
     * @param Request $request
     * @param String $providerName
     * @return response
     */
    public function notify(Request $request, $providerName)
    {
        $provider = $this->getProvider($providerName);
        $response = $provider->notify($request);
        $pay = $provider->getPay();
        $pay->setStatus('paid');
        $pay->setPaidTime();
        $this->doctrineManager->update($pay);
        $event = new PayEvent($pay);
        $this->dispatcher->dispatch(GloryPayEvents::PAY_SUCCESS, $event);
        return $response;
    }

}
