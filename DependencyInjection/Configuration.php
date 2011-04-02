<?php

namespace CleverAge\Bundle\LifestreamBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\NodeBuilder,
    Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * This class contains the configuration information for the bundle
 *
 * This information is solely responsible for how the different configuration
 * sections are normalized, and merged.
 */
class Configuration
{
    /**
     * Generates the configuration tree.
     *
     * @return \Symfony\Component\DependencyInjection\Configuration\NodeInterface
     */
    public function getConfigTree()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('clever_age_lifestream', 'array');

        $rootNode
            ->children()
                ->scalarNode('class')
                    ->defaultValue('CleverAge\Bundle\LifestreamBundle\ApiClient\Lifestream')
                ->end()
                ->arrayNode('apis')
                    ->isRequired()
                    ->requiresAtLeastOneElement()
                ->end()
            ->end()
        ->end();

        return $treeBuilder->buildTree();
    }

}