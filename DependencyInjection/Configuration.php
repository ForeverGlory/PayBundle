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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('glory_pay');

        $rootNode
                ->children()
                    ->scalarNode('pay_class')->defaultValue('Glory\\Bundle\\PayBundle\\Entity\\Pay')->end()
                    ->arrayNode('provider')
                        ->useAttributeAsKey('name')
                        ->prototype('array')
                            ->ignoreExtraKeys(false)
                            ->children()
                                ->scalarNode('type')->cannotBeEmpty()->end()
                                ->scalarNode('id')->cannotBeEmpty()->end()
                                ->scalarNode('key')->cannotBeEmpty()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end();

        return $treeBuilder;
    }

}
