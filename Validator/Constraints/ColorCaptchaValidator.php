<?php

namespace Yamilovs\ColorCaptchaBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Yamilovs\ColorCaptchaBundle\Manager\ColorCaptchaFactory;

class ColorCaptchaValidator extends ConstraintValidator
{
    protected $captchaFactory;

    public function __construct(ColorCaptchaFactory $captchaFactory)
    {
        $this->captchaFactory = $captchaFactory;
    }

    public function validate($value, Constraint $constraint)
    {
        $sessionColorCaptchaValue = $this->captchaFactory->getSessionColor();

        if (!$sessionColorCaptchaValue or strtoupper($value) != $sessionColorCaptchaValue) {
            $this->context->buildViolation($constraint->notEqualMessage)
                ->addViolation();
        }
    }
}