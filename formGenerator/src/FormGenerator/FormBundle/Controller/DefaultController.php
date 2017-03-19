<?php

namespace FormGenerator\FormBundle\Controller;

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

    $form = $this->createFormBuilder()
        ->add('Topic', TopicType::class)
        ->getForm();

    return $this->render('FormGeneratorFormBundle:Default:form.html.twig',array(
        'form' => $form->createView()
    ));
}


public function afficherTopicAction(Request $request,$id){
        $res=[];
        $em = $this->getDoctrine()
            ->getManager();
        $query = $em->createQuery('
        SELECT q
        FROM FormGeneratorFormBundle:Question q
        WHERE q.topicId=:tId')
            ->setParameter('tId',$id);//feth questions related to topic
        $questions =$query->getResult();
        foreach ($questions as $q){
            $query = $em->createQuery('
            SELECT answer
            FROM FormGeneratorFormBundle:Answer answer 
            WHERE answer.questionId=:qId')
                ->setParameter('qId',$q->getId());//getch answers related to questions
            $res[]=array(
              "question"=>$q,
                "reponses"=>$query->getResult()
            );
        }
        //create form

    $form = $this->createFormBuilder();
    for ($i=0;$i<count($res);$i++){

        //tableau de reponse
        $a = [];//sert pour les réponses dans le form
        for ($j=0;$j<count($res[$i]["reponses"]);$j++){
            $a[$res[$i]["reponses"][$j]->getAnswer()]=$res[$i]["reponses"][$j]->getId();//$a[answer]=id || "answ"=>"id"
        }
        /*$form->add('questions',CollectionType::class,array(
           'entry_type' => ChoiceType::class,
            'allow_add' => 'true',
            'entry_options' => array(
                'label'=>$res[$i]["question"]->getQuestion(),
                'choices'=>$a,
                'required'=>'true',
                'expanded'=>'true',
                'multiple'=>$res[$i]["question"]->getIsMultiple()//true => checkbox || false=> radio button
            )
        ));*/
       $form->add($res[$i]["question"]->getId(),ChoiceType::class,array(
            'label'=>$res[$i]["question"]->getQuestion(),
            'choices'=>$a,
            'required'=>'true',
            'expanded'=>'true',
            'multiple'=>$res[$i]["question"]->getIsMultiple()//true => checkbox || false=> radio button
            //putain de doc de merde
        ));
    }// FIN CREATE QUESTIONNAIRE

    $form->add("Check your privilege !",SubmitType::class);
    $form= $form->getForm();
    $form->handleRequest($request);
    //FORM SUBMIT
    if ($form->isSubmitted()){
        $note=0;
        $data = $form->getData();
        for ($i=1;$i<=count($data);$i++){
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
        }
        return $this->resultatAction($note);
    }
    //END FORM SUBMIT
        return $this->render('FormGeneratorFormBundle:Default:resTopic.html.twig',array(
            "form"=>$form->createView(),
            "res"=>$res
        ));
}
public function resultatAction($note){
    return $this->render('FormGeneratorFormBundle:Default:resultat.html.twig',array(
        'note'=>$note
    ));
}
    /*public function addQuestionAction(Request $request){
        $form = $this->createFormBuilder()
            ->add('Questions', QuestionType::class)
            ->getForm();


        return $this->render('FormGeneratorFormBundle:Default:questionsForm.html.twig',array(
            'form' => $form->createView()
        ));
    }*/
}
