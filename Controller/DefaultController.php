<?php

namespace Yamilovs\ColorCaptchaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('YamilovsColorCaptchaBundle:Default:index.html.twig');
    }
}
