<?php

namespace Stringkey\MapperBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('stringkey_mapper');
        $rootNode = $treeBuilder->getRootNode();
//        $rootNode->
//             children()
//                ->booleanNode('auto_map')
//                    ->defaultTrue()
//                ->end()
//                ->booleanNode('ignore_unicorns')
//                ->end()
//            ->end();

        return $treeBuilder;
    }
}
