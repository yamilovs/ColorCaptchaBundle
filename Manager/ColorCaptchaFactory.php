<?php

namespace Yamilovs\ColorCaptchaBundle\Manager;

use Symfony\Component\HttpFoundation\Session\Session;
use Yamilovs\ColorCaptchaBundle\Color\ColorInterface;

class ColorCaptchaFactory
{
    CONST COLOR_CAPTCHA_SESSION_COLORS              = 'ColorCaptchaTargetColors';
    CONST COLOR_CAPTCHA_SESSION_TARGET_COLOR        = 'ColorCaptchaTargetColor';
    CONST COLOR_CAPTCHA_SESSION_TARGET_COLOR_TEXT   = 'ColorCaptchaTargetColorText';

    protected $session;
    protected $colors;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function setCaptchaColor(ColorInterface $color)
    {
        $this->colors[] = $color;
    }

    public function getSessionColor()
    {
        return $this->session->get(self::COLOR_CAPTCHA_SESSION_TARGET_COLOR) ?: null;
    }

    public function setSessionColors()
    {
        if (!$this->session->get(self::COLOR_CAPTCHA_SESSION_COLORS)) {
            $this->generateSessionColors();
        }
    }

    public function generateNewSessionColors()
    {
        $this->generateSessionColors();
    }

    protected function generateSessionColors()
    {
        $colors = $this->getRandomColors();
        $one_color = array_rand($colors);

        $this->session->set(self::COLOR_CAPTCHA_SESSION_COLORS,             $colors);
        $this->session->set(self::COLOR_CAPTCHA_SESSION_TARGET_COLOR,       $colors[$one_color]);
        $this->session->set(self::COLOR_CAPTCHA_SESSION_TARGET_COLOR_TEXT,  $one_color);
    }

    protected function getRandomColors()
    {
        $result = array();
        shuffle($this->colors);

        /** @var ColorInterface $color */
        foreach ($this->colors as $color) {
            $result[$color->getAlias()] = $color->generate();
        }

        return $result;
    }
}