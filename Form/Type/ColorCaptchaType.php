<?php

namespace Yamilovs\ColorCaptchaBundle\Form\Type;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ColorCaptchaType extends AbstractType
{
    protected $colorCaptchaListener;

    protected $helpTextPosition;

    public function __construct(EventSubscriberInterface $colorCaptchaListener, $helpTextPosition)
    {
        $this->colorCaptchaListener = $colorCaptchaListener;
        $this->helpTextPosition = $helpTextPosition;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addEventSubscriber($this->colorCaptchaListener)
            ->setAttribute('help_text_position', $options['help_text_position'])
        ;
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $config = $form->getConfig();

        $view->vars['help_text_position'] = $config->getAttribute('help_text_position');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'help_text_position' => $this->helpTextPosition,
                'label' => false,
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'yamilovs.color_captcha.not_blank',
                    ]),
                    new Length([
                        'max' => 7,
                        'min' => 7,
                        'exactMessage' => 'yamilovs.color_captcha.exact',
                    ]),
                ],
            ])
            ->addAllowedTypes('help_text_position', 'string')
        ;
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
