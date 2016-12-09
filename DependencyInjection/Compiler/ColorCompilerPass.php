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

        $definition = $container->findDefinition('yamilovs.color_captcha.factory');
        $taggedServices = $container->findTaggedServiceIds('ColorCaptchaColor');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('setCaptchaColor', array(new Reference($id)));
        }
    }
}
