<?php

namespace FormGenerator\FormBundle\Controller;

use FormGenerator\FormBundle\Entity\Topic;
use FormGenerator\FormBundle\Form\QuestionType;
use FormGenerator\FormBundle\Form\TopicType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request){
        $topic = new Topic();
        $questions = [];
        $answer = [];

        $form = $this->createFormBuilder()
            ->add('Topic', TopicType::class)
            ->add('Question', CollectionType::class, array(
                'entry_type'         => QuestionType::class,
                'allow_add'    => true,
                'allow_delete' => true
            ))
            ->add('save', SubmitType::class)
            ->getForm();
        if ($request->isMethod('POST')) {
                $a =  $form->handleRequest($request);
                var_dump($_POST['form']);
                return $this->redirect($this->generateUrl('form_generator_form_addQuestion', array('values' => var_dump($a))));
        }
        return $this->render('FormGeneratorFormBundle:Default:form.html.twig',array('form' => $form->createView()));
}

    public function addQuestionAction(Request $request){
        $form = $this->createFormBuilder()
            ->add('Questions', QuestionType::class)
            ->getForm();


        return $this->render('FormGeneratorFormBundle:Default:questionsForm.html.twig',array(
            'form' => $form->createView()
        ));
    }
}
