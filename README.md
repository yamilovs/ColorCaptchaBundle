[![Build Status](https://travis-ci.org/yamilovs/ColorCaptchaBundle.svg?branch=master)](https://travis-ci.org/yamilovs/ColorCaptchaBundle)

ColorCaptchaBundle
==================

This bundle will help you to implement a captcha feature with auto generated colors.

Installation
------------

### Step 1: Download YamilovsColorCaptchaBundle using composer

Add YamilovsColorCaptchaBundle by running the command:

``` bash
$ php composer.phar require yamilovs/color-captcha-bundle ^1.0
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Yamilovs\ColorCaptchaBundle\YamilovsColorCaptchaBundle(),
    );
}
```

Usage
-----
In your form type add ColorCaptchaType:
```php
<?php
// src/FooBundle/Form/Type/BarType.php

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Yamilovs\ColorCaptchaBundle\Form\Type\ColorCaptchaType;

class BarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //..
            ->add('captcha', ColorCaptchaType::class)
        ;
    }
}
```

Then, add some styles for captcha markup. For a sample, in your css file:
```css
.captcha-block {
  font-size: 18px;
}
.captcha-block .captcha-color {
    cursor: pointer;
    width: 50px;
    height: 50px;
    margin: 0 10px 0 0;
    float: left;
    transition: all 0.35s ease 0s;
}
.captcha-block .captcha-color:hover {
    opacity: 0.7;
}
.captcha-block .captcha-color.selected {
    -webkit-box-shadow: inset 0px 0px 0px 8px rgba(255,255,255,0.5);
    -moz-box-shadow: inset 0px 0px 0px 8px rgba(255,255,255,0.5);
    box-shadow: inset 0px 0px 0px 8px rgba(255,255,255,0.5);
}
```

**That's all!**

ToDo:
-----
* How to create your own colors
* How to increase or decrease number of colors (need configuration implementation)