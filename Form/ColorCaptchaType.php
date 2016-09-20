<?php

namespace Yamilovs\ColorCaptchaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Yamilovs\ColorCaptchaBundle\Manager\ColorCaptchaManager;
use Yamilovs\ColorCaptchaBundle\Validator\Constraints\ColorCaptchaConstraint;

class ColorCaptchaType extends AbstractType
{
    public function __construct(ColorCaptchaManager $captchaManager)
    {
        $captchaManager->setSessionColors();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'label'         => false,
            'mapped'        => false,
            'required'      => true,
            'constraints'   => array(
                new NotBlank(array(
                    'message' => 'yamilovs.color_captcha.not_blank',
                )),
                new Length(array(
                    'max'           => 7,
                    'min'           => 7,
                    'exactMessage'  => 'yamilovs.color_captcha.exact',
                )),
                new ColorCaptchaConstraint(array(
                    'notEqualMessage' => 'yamilovs.color_captcha.not_equal'
                )),
            ),
        ));
    }

    public function getParent()
    {
        return TextType::class;
    }

    public function getBlockPrefix()
    {
        return 'color_captcha';
    }
}