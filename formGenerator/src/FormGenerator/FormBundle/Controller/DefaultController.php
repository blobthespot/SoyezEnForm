<?php

namespace FormGenerator\FormBundle\Controller;

use FormGenerator\FormBundle\Entity\Result;
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
    public function createTopicAction(Request $request){
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
        $form->add("Nom",TextType::class);
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
        $result = new Result();
        if ($form->isSubmitted()){
            $note=0;
            foreach ($form->getData() as $AnswerId){
                if (is_numeric($AnswerId)){
                    $formAnswer = $this->getDoctrine()->getRepository('FormGeneratorFormBundle:Answer')->find($AnswerId);
                    if ($formAnswer->getIsCorrect()){ $note += 1; }
                }

            }

            $result->setName($form->getData()["Nom"]);
            $result->setScore($note);
            $result->setTopicId($topic);

            $em = $this->getDoctrine()->getManager();

            // tells Doctrine you want to (eventually) save the Product (no queries yet)
            $em->persist($result);

            // actually executes the queries (i.e. the INSERT query)
            $em->flush();

        return $this->resultatAction($note);
    }
        return $this->render('FormGeneratorFormBundle:Default:resTopic.html.twig',array(
            "form"=>$form->createView()
        ));
}

    public function resultatAction($note){
        return $this->render('FormGeneratorFormBundle:Default:resultat.html.twig',array(
            'note'=>$note
        ));
    }

    public function indexAction(){
        $allTopic = $this->getDoctrine()->getRepository('FormGeneratorFormBundle:Topic')->findAll();
        return $this->render('FormGeneratorFormBundle:Default:allTopic.html.twig',array(
            'topics'=>$allTopic,
            //var_dump($allTopic)
        ));

    }


    /**
     * La fonction permet de données tous les résultats du formulaire sélectionné avec les noms des utilisateurs.
     * @param $id
     */
    public function allresultsTopicAction($id){
        $em = $this->getDoctrine()->getManager();
        //Récupérer les données des resultats du formulaire courant
        $results = $em->getRepository('FormGeneratorFormBundle:Result')->findByTopicId($id);
        //Récupérer le topic utilisé
        $topic = $em->getRepository('FormGeneratorFormBundle:Topic')->find($id);

        $topicName = $topic->getName();
        $nbQuestions = count($topic->getQuestions());
        foreach($results as $result){
            $data[] = $result->getName();
        }
        return $this->render('FormGeneratorFormBundle:Default:allresults.html.twig',array(
            "results" => $results,
            "name" => $topicName,
            "nbQuestion" => $nbQuestions
        ));
    }
}
