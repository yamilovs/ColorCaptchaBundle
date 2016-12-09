<?php

namespace Yamilovs\ColorCaptchaBundle\Color;

class PinkColor implements ColorInterface
{
    public function getAlias()
    {
        return "pink";
    }

    public function generate()
    {
        return "#" . dechex(mt_rand(200, 255)) . dechex(mt_rand(17, 50)) . dechex(mt_rand(200, 255));
    }
}
