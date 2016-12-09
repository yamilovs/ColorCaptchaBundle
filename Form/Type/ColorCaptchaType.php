<?php

namespace Yamilovs\ColorCaptchaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Translation\TranslatorInterface;
use Yamilovs\ColorCaptchaBundle\Form\EventListener\ColorCaptchaListener;
use Yamilovs\ColorCaptchaBundle\Manager\ColorCaptchaFactory;

class ColorCaptchaType extends AbstractType
{
    protected $captchaFactory;
    protected $translator;
    protected $translationDomain;

    public function __construct(ColorCaptchaFactory $captchaFactory, TranslatorInterface $translator, $translationDomain = null)
    {
        $this->captchaFactory = $captchaFactory;
        $this->translator = $translator;
        $this->translationDomain = $translationDomain;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addEventSubscriber(
                new ColorCaptchaListener(
                    $this->captchaFactory,
                    $this->translator,
                    $this->translationDomain
                )
            )
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
