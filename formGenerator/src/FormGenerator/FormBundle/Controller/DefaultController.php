<?php

namespace FormGenerator\FormBundle\Controller;

<<<<<<< HEAD
use FormGenerator\FormBundle\Entity\Topic;
use FormGenerator\FormBundle\Form\QuestionType;
use FormGenerator\FormBundle\Form\TopicType;
=======
use FormGenerator\FormBundle\Entity\Answer;
use FormGenerator\FormBundle\Entity\Question;
use FormGenerator\FormBundle\Entity\Topic;
use FormGenerator\FormBundle\Models\Form;
use FormGenerator\FormBundle\Models\Reponse;
>>>>>>> ee8b240c46b217e5d9d005ea75a453e14725dd6d
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request){
    $topic = new Topic();

<<<<<<< HEAD
    $form = $this->createFormBuilder()
        ->add('Topic', TopicType::class)
        ->getForm();

    return $this->render('FormGeneratorFormBundle:Default:form.html.twig',array(
        'form' => $form->createView()
    ));
}

    public function addQuestionAction(Request $request){
        $form = $this->createFormBuilder()
            ->add('Questions', QuestionType::class)
            ->getForm();


        return $this->render('FormGeneratorFormBundle:Default:questionsForm.html.twig',array(
            'form' => $form->createView()
=======
        $form = $this->createFormBuilder($formulaire)
            ->add('Name', TextType::class)

            ->add('save', SubmitType::class, array('label' => "J/'aime la bite" ))
            ->getForm();
        $res = $this->getData();
        return $this->render('FormGeneratorFormBundle:Default:form.html.twig',array(
            'form' => $form->createView(),
            'res'=>$res
>>>>>>> ee8b240c46b217e5d9d005ea75a453e14725dd6d
        ));
    }
    public function addData(){
        $topic = new Topic();
        $topic->setName("Premier Topic");

        $em = $this->getDoctrine()->getManager();
        $em->persist($topic);
        $em->flush();
    }
    public function getData(){
        $answer = $this->getDoctrine()->getRepository("FormGeneratorFormBundle:Topic")->findAll();
        return $answer;
    }
}
