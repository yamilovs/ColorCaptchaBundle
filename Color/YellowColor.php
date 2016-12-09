<?php

namespace Yamilovs\ColorCaptchaBundle\Color;

class YellowColor implements ColorInterface
{
    public function generate()
    {
        return "#" . dechex(mt_rand(200, 255)) . dechex(mt_rand(200, 255)) . dechex(mt_rand(17, 50));
    }
}
