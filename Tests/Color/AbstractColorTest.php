<?php

namespace Yamilovs\ColorCaptchaBundle\Tests\Color;

use Yamilovs\ColorCaptchaBundle\Color\ColorInterface;

abstract class AbstractColorTest extends \PHPUnit_Framework_TestCase
{
    abstract function getColorAlias();

    /**
     * @return ColorInterface
     */
    protected function getColor()
    {
        return $this->getMockBuilder('Yamilovs\ColorCaptchaBundle\Color\\' . ucfirst($this->getColorAlias()) . 'Color')
            ->getMockForAbstractClass();
    }

    public function testGenerateReturnCorrectColorString()
    {
        $color = $this->getColor();
        $this->assertRegExp('/^#[\d\w]{6}$/', $color->generate());;
    }

    public function testColorAliasIsValidForFileName()
    {
        $color = $this->getColor();
        $this->assertInstanceOf(ColorInterface::class, $color);
        $this->assertEquals($this->getColorAlias(), $color->getAlias());
    }
}