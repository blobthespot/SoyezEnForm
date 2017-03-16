<?php

namespace FormGenerator\FormBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FormGeneratorFormBundle:Default:index.html.twig');
    }
}
