<?php

namespace Yamilovs\ColorCaptchaBundle\Tests\Color;

use Yamilovs\ColorCaptchaBundle\Color\ColorInterface;

abstract class AbstractColorTest extends \PHPUnit_Framework_TestCase
{
    abstract function getColorAlias();

    /**
     * @return ColorInterface
     */
    protected function getMockColor()
    {
        return $this->getMockBuilder('Yamilovs\ColorCaptchaBundle\Color\\' . ucfirst($this->getColorAlias()) . 'Color')
            ->getMockForAbstractClass();
    }

    public function testColorAlias()
    {
        $color = $this->getMockColor();
        $this->assertInstanceOf(ColorInterface::class, $color);
        $this->assertEquals($this->getColorAlias(), $color->getAlias());
    }
}