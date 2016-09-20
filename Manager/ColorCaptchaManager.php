<?php

namespace Yamilovs\ColorCaptchaBundle\Manager;

use Symfony\Component\HttpFoundation\Session\Session;

class ColorCaptchaManager
{
    CONST COLOR_CAPTCHA_SESSION_COLORS              = 'ColorCaptchaTargetColors';
    CONST COLOR_CAPTCHA_SESSION_TARGET_COLOR        = 'ColorCaptchaTargetColor';
    CONST COLOR_CAPTCHA_SESSION_TARGET_COLOR_TEXT   = 'ColorCaptchaTargetColorText';

    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
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











    // Create factory

    protected function getRandomColors()
    {
        $colors = array('red','green','blue','yellow','grey', 'pink');
        shuffle($colors);
        return $this->generateColors($colors);
    }

    protected function generateColors($keys) {
        $result = array();

        foreach ($keys as $key) {
            $method = "generate".ucfirst($key);

            if (!method_exists($this, $method)) {
                throw new \BadMethodCallException("You try to use non exists method '$method'.");
            }

            $result[$key] = strtoupper("#".$this->$method());
        }
        return $result;
    }

    protected function generateYellow() {
        return dechex(mt_rand(200,255)).dechex(mt_rand(200,255)).dechex(mt_rand(17,50));
    }

    protected function generateGrey() {
        return dechex(mt_rand(70,80)).dechex(mt_rand(70,80)).dechex(mt_rand(70,80));
    }

    protected function generateBlue() {
        return dechex(mt_rand(17,50)).dechex(mt_rand(17,50)).dechex(mt_rand(200,255));
    }

    protected function generateRed() {
        return dechex(mt_rand(200,255)).dechex(mt_rand(17,50)).dechex(mt_rand(17,50));
    }

    protected function generateGreen() {
        return dechex(mt_rand(17,50)).dechex(mt_rand(200,255)).dechex(mt_rand(17,50));
    }

    protected function generatePink() {
        return dechex(mt_rand(200,255)).dechex(mt_rand(17,50)).dechex(mt_rand(200,255));
    }
}