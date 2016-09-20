<?php

namespace Yamilovs\ColorCaptchaBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Yamilovs\ColorCaptchaBundle\DependencyInjection\Compiler\ColorCompilerPass;

class YamilovsColorCaptchaBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ColorCompilerPass());
    }
}
