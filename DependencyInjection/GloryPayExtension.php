<?php

/*
 * This file is part of the current project.
 * 
 * (c) ForeverGlory <http://foreverglory.me/>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Glory\Bundle\PayBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class GloryPayExtension extends Extension
{

    protected $providerConfigs = [];

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $container->getDefinition('glory_pay.pay_manager')
                ->addMethodCall('setClass', [$config['pay_class']]);

        foreach ($config['provider'] as $name => $configuration) {
            $this->createPayProvider($container, $name, $configuration);
        }
    }

    public function createPayProvider(ContainerBuilder$container, $name, array $configuration = [])
    {
        $providerName = 'glory_pay.provider.' . $name;
        $definition = new DefinitionDecorator('glory_pay.provider.type.' . $configuration['type']);
        $container->setDefinition($providerName, $definition)
                ->addMethodCall('setOption', [$configuration]);
        $container->getDefinition('glory_pay.pay_service')
                ->addMethodCall('addProvider', [$name, new Reference($providerName)]);
    }

}
