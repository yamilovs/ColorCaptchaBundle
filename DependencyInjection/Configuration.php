<?php

namespace Yamilovs\ColorCaptchaBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('yamilovs_color_captcha');

        $rootNode
            ->children()
                ->arrayNode('help_text')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('position')->defaultValue('bottom')->end()
                    ->end()
                ->end()
            ->end()
            ->fixXmlConfig('color')
            ->children()
                ->arrayNode('colors')
                    ->prototype('scalar')->defaultNull()->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
