<?php

namespace Yamilovs\ColorCaptchaBundle\Color;

interface ColorInterface
{
    public function getAlias();

    public function generate();
}
