<?php

namespace Yamilovs\ColorCaptchaBundle\Form\EventListener;

use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Yamilovs\ColorCaptchaBundle\Manager\ColorCaptchaFactory;

class ColorCaptchaListener implements EventSubscriberInterface
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

    public function preSetData(FormEvent $event)
    {
        $this->captchaFactory->setSessionColors();
    }

    public function preSubmit(FormEvent $event)
    {
        $form = $event->getForm();
        $selectedColor = $event->getData();
        $sessionColor = $this->captchaFactory->getSessionColor();

        if ($selectedColor == $sessionColor) {
            $this->captchaFactory->generateNewSessionColors();
        } else {
            $form->addError(new FormError($this->translator->trans('yamilovs.color_captcha.not_equal', array(), $this->translationDomain)));
        }

    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SUBMIT  => 'preSubmit',
            FormEvents::PRE_SET_DATA => 'preSetData',
        );
    }
}
