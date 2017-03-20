<?php

namespace FormGenerator\FormBundle\Controller;

use FormGenerator\FormBundle\Entity\Topic;
use FormGenerator\FormBundle\Form\QuestionType;
use FormGenerator\FormBundle\Form\TopicType;
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

        $form = $this->createForm(TopicType::class, $topic);
        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getEntityManager();

            foreach ($topic->getQuestions() as $question) {
                $valium = $question->getAnswers();
                foreach ($question->getAnswers() as $answer){
                    $answer->setQuestion($question);
                }

                $question->setTopic($topic);
            }

            $em->persist($topic);
            $em->flush();
            return $this->redirect($this->generateUrl('form_generator_form_addQuestion'), array('value' => var_dump($_POST)));
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
