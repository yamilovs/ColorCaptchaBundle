<?php

namespace Yamilovs\ColorCaptchaBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Yamilovs\ColorCaptchaBundle\Manager\ColorCaptchaManager;

class ColorCaptchaValidator extends ConstraintValidator
{
    protected $captchaManager;

    public function __construct(ColorCaptchaManager $captchaManager)
    {
        $this->captchaManager = $captchaManager;
    }

    public function validate($value, Constraint $constraint)
    {
        $sessionColorCaptchaValue = $this->captchaManager->getSessionColor();

        if (!$sessionColorCaptchaValue or strtoupper($value) != $sessionColorCaptchaValue) {
            $this->context->buildViolation($constraint->notEqualMessage)
                ->addViolation();
        }
    }
}