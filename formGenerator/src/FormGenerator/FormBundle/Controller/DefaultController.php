<?php

namespace FormGenerator\FormBundle\Controller;

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
            ->add('QuestionS', CollectionType::class, array(
                'entry_type'   => Reponse::class,
                'entry_options'  => array(
                    'attr'      => array('class' => 'email-box')
                )
            ))
            ->add('save', SubmitType::class, array('label' => 'Create Post'))
            ->getForm();

        return $this->render('FormGeneratorFormBundle:Default:form.html.twig',array(
            'form' => $form->createView()
        ));
    }
}
