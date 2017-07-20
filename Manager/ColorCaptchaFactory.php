<?php

namespace Yamilovs\ColorCaptchaBundle\Manager;

use Symfony\Component\HttpFoundation\Session\Session;
use Yamilovs\ColorCaptchaBundle\Color\ColorInterface;

class ColorCaptchaFactory
{
    CONST COLOR_CAPTCHA_SESSION_COLORS = 'ColorCaptchaTargetColors';
    CONST COLOR_CAPTCHA_SESSION_TARGET_COLOR = 'ColorCaptchaTargetColor';
    CONST COLOR_CAPTCHA_SESSION_TARGET_COLOR_TEXT = 'ColorCaptchaTargetColorText';

    protected $session;
    protected $colors;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function setCaptchaColor(ColorInterface $color, $alias)
    {
        $this->colors[$alias] = $color;
    }

    public function getSessionColor()
    {
        return $this->session->get(self::COLOR_CAPTCHA_SESSION_TARGET_COLOR);
    }

    public function setSessionColors()
    {
        if (!$this->session->get(self::COLOR_CAPTCHA_SESSION_COLORS)) {
            $this->generateNewSessionColors();
        }
    }

    public function getSessionColors()
    {
        return $this->session->get(self::COLOR_CAPTCHA_SESSION_COLORS);
    }

    public function generateNewSessionColors()
    {
        $this->generateSessionColors();
    }

    protected function generateSessionColors()
    {
        $colors = $this->getRandomColors();
        $key = array_rand($colors);

        $this->session->set(self::COLOR_CAPTCHA_SESSION_COLORS,             $colors);
        $this->session->set(self::COLOR_CAPTCHA_SESSION_TARGET_COLOR,       $colors[$key]);
        $this->session->set(self::COLOR_CAPTCHA_SESSION_TARGET_COLOR_TEXT,  $key);
    }

    protected function getRandomColors()
    {
        $result = array();
        $keys = array_keys($this->colors);
        shuffle($keys);

        foreach ($keys as $key) {
            $result[$key] = $this->colors[$key]->generate();
        }

        return $result;
    }
}
