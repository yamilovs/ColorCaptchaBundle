<?php

namespace Yamilovs\ColorCaptchaBundle\Color;

class GreyColor implements ColorInterface
{
    public function generate()
    {
        return "#" . dechex(mt_rand(70, 80)) . dechex(mt_rand(70, 80)) . dechex(mt_rand(70, 80));
    }
}
