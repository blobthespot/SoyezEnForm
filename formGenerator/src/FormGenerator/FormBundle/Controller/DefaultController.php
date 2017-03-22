<?php

namespace FormGenerator\FormBundle\Controller;

use Symfony\Component\Form\FormBuilder;
use FormGenerator\FormBundle\Entity\Topic;
use FormGenerator\FormBundle\Form\QuestionType;
use FormGenerator\FormBundle\Form\TopicType;
use FormGenerator\FormBundle\FormGeneratorFormBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Choice;

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
            return $this->redirectToRoute('form_generator_form_afficherTopic', array(
                'id' => $topic->getId()
            ));
        }
        return $this->render('FormGeneratorFormBundle:Default:form.html.twig',array('form' => $form->createView()));
}

    public function afficherTopicAction(Request $request,$id){
        $em = $this->getDoctrine()->getManager();

        $topic = $em->getRepository('FormGeneratorFormBundle:Topic')->find($id);

        $questions = $topic->getQuestions();

        //create form
        $form = $this->createFormBuilder();
        foreach ($questions as $question){
            $answers = $question->getAnswers();
            $answersString = [];
            foreach ($answers as $answer){
                $answersString[$answer->getAnswer()] = $answer->getId();
            }
            $form->add($question->getId(),ChoiceType::class,array(
                'label'=>$question->getQuestion(),
                'choices'=>$answersString,
                'required'=>'true',
                'expanded'=>'true',
                'multiple'=>$question->getIsMultiple()//true => checkbox || false=> radio button
            ));
        }
        $form->add("Valider votre formulaire !",SubmitType::class);
        $form= $form->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $note=0;
            foreach ($form->getData() as $AnswerId){
                $formAnswer = $this->getDoctrine()->getRepository('FormGeneratorFormBundle:Answer')->find($AnswerId);
                if ($formAnswer->getIsCorrect()){ $note += 1; }
            }
            /*for ($i=1;$i<=count($data);$i++){
                $item = $data[$i];
                if(is_array($item)){
                    foreach ($item as $tuple){
                        $res = $this->getDoctrine()
                        ->getRepository('FormGeneratorFormBundle:Answer')
                        ->find($tuple);
                    if ($res->getIsCorrect()) $note++;
                }
            }
            else
            {
                $res = $this->getDoctrine()
                    ->getRepository('FormGeneratorFormBundle:Answer')
                    ->find($item);
                if ($res->getIsCorrect()) $note++;
            }
        }*/
        return $this->resultatAction($note);
    }

    //END FORM SUBMIT
        return $this->render('FormGeneratorFormBundle:Default:resTopic.html.twig',array(
            "form"=>$form->createView(),
            //"res"=>$res
        ));
}

    public function resultatAction($note){
        return $this->render('FormGeneratorFormBundle:Default:resultat.html.twig',array(
            'note'=>$note
        ));
    }
}
