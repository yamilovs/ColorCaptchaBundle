<?php

namespace Yamilovs\ColorCaptchaBundle\Color;

class GreenColor implements ColorInterface
{
    public function generate()
    {
        return "#" . dechex(mt_rand(17, 50)) . dechex(mt_rand(200, 255)) . dechex(mt_rand(17, 50));
    }
}
