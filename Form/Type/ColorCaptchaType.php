<?php

namespace Yamilovs\ColorCaptchaBundle\Form\Type;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ColorCaptchaType extends AbstractType
{
    protected $colorCaptchaListener;

    public function __construct(EventSubscriberInterface $colorCaptchaListener)
    {
        $this->colorCaptchaListener = $colorCaptchaListener;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addEventSubscriber($this->colorCaptchaListener)
        ;
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
