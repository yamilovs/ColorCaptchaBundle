<?php

namespace Yamilovs\ColorCaptchaBundle\Color;

class BlueColor implements ColorInterface
{
    public function getAlias()
    {
        return "blue";
    }

    public function generate()
    {
        return "#" . dechex(mt_rand(17, 50)) . dechex(mt_rand(17, 50)) . dechex(mt_rand(200, 255));
    }
}
