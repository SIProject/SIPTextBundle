<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\TextBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sip_text');

        $rootNode
            ->children()
                ->scalarNode('model')->cannotBeEmpty()->end()
                ->scalarNode('controller')->defaultValue('SIP\\TextBundle\\Controller\\TextController')->end()
                ->scalarNode('repository')->defaultValue('SIP\\ResourceBundle\\Repository\\EntityRepository')->end()
                ->scalarNode('admin')->defaultValue('SIP\\TextBundle\\Admin\\TextAdmin')->end()
                ->scalarNode('manager_type')->defaultValue('orm')->end()
            ->end();

        return $treeBuilder;
    }
}