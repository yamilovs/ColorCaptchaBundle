<?php

namespace Yamilovs\ColorCaptchaBundle\Tests\Manager;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Session\Session;
use Yamilovs\ColorCaptchaBundle\Color\BlueColor;
use Yamilovs\ColorCaptchaBundle\Color\ColorInterface;
use Yamilovs\ColorCaptchaBundle\Color\GreenColor;
use Yamilovs\ColorCaptchaBundle\Color\GreyColor;
use Yamilovs\ColorCaptchaBundle\Color\PinkColor;
use Yamilovs\ColorCaptchaBundle\Color\RedColor;
use Yamilovs\ColorCaptchaBundle\Color\YellowColor;
use Yamilovs\ColorCaptchaBundle\Manager\ColorCaptchaFactory;

class ColorCaptchaFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var  SessionInterface */
    protected $session;
    protected $colors;

    /**
     * @return ColorInterface
     */
    protected function getColor()
    {
        return $this->getMockBuilder(ColorInterface::class)->getMock();
    }

    /**
     * @return ColorCaptchaFactory
     */
    protected function getColorCaptchaFactoryWithColors()
    {
        $this->session = new Session(new MockArraySessionStorage());
        $this->colors = [
            'blue' => new BlueColor(),
            'green' => new GreenColor(),
            'grey' => new GreyColor(),
            'pink' => new PinkColor(),
            'red' => new RedColor(),
            'yellow' => new YellowColor()
        ];

        $factory = $this->getMockBuilder(ColorCaptchaFactory::class)
            ->setConstructorArgs([$this->session])
            ->getMockForAbstractClass();

        foreach ($this->colors as $alias => $color) {
            $factory->setCaptchaColor($color, $alias);
        }

        return $factory;
    }

    public function testSettingColorsToSession()
    {
        $factory = $this->getColorCaptchaFactoryWithColors();
        $session = $this->session;

        $factory->setSessionColors();

        $expectedColor = $factory->getSessionColor();;
        $color = $session->get(ColorCaptchaFactory::COLOR_CAPTCHA_SESSION_TARGET_COLOR);
        $colors = $session->get(ColorCaptchaFactory::COLOR_CAPTCHA_SESSION_COLORS);
        $colorText = $session->get(ColorCaptchaFactory::COLOR_CAPTCHA_SESSION_TARGET_COLOR_TEXT);

        $this->assertRegExp('/^#[\d\w]{6}$/', $color);
        $this->assertRegExp('/^[\w]+$/', $colorText);
        $this->assertEquals($color, $colors[$colorText]);
        $this->assertEquals($expectedColor, $color);
    }

    public function testGettingSessionColor()
    {
        $factory = $this->getColorCaptchaFactoryWithColors();
        $nullColor = $factory->getSessionColor();

        $factory->generateNewSessionColors();
        $color = $factory->getSessionColor();

        $factory->setSessionColors(); // Using this method should not change anything because session already has one selected color
        $newColor = $factory->getSessionColor();

        $this->assertNull($nullColor);
        $this->assertEquals($color, $newColor);
    }
}