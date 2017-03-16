<?php

namespace FormGenerator\FormBundle\Controller;

use FormGenerator\FormBundle\Entity\Question;
use FormGenerator\FormBundle\Models\Form;
use FormGenerator\FormBundle\Models\Reponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class DefaultController extends Controller
{
    public function indexAction(){
        $formulaire = new Form();

        $form = $this->createFormBuilder($formulaire)
            ->add('Name', TextType::class)
            ->add('Questions', Question::class)
            ->add('save', SubmitType::class, array('label' => "J/'aime la bite" ))
            ->getForm();

        return $this->render('FormGeneratorFormBundle:Default:form.html.twig',array(
            'form' => $form->createView()
        ));
    }
}
