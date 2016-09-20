<?php

namespace Yamilovs\ColorCaptchaBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ColorCaptchaConstraint extends Constraint
{
    public $notEqualMessage = "yamilovs.color_captcha.not_equal";

    public function validatedBy()
    {
        return ColorCaptchaValidator::class;
    }
}