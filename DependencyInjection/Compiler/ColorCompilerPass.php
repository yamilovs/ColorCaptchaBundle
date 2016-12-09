<?php

namespace Yamilovs\ColorCaptchaBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class ColorCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('yamilovs.color_captcha.factory')) {
            return;
        }

        $colors = $container->getParameter('yamilovs_color_captcha.colors');

        $definition = $container->findDefinition('yamilovs.color_captcha.factory');
        $taggedServices = $container->findTaggedServiceIds('ColorCaptchaColor');

        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                if (empty($colors) or in_array($attributes['alias'], $colors)) {
                    $definition->addMethodCall('setCaptchaColor',
                        [
                            new Reference($id),
                            $attributes['alias']
                        ]
                    );
                }
            }
        }
    }
}
