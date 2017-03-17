<?php

namespace FormGenerator\FormBundle\Controller;

use FormGenerator\FormBundle\Entity\Answer;
use FormGenerator\FormBundle\Entity\Question;
use FormGenerator\FormBundle\Entity\Topic;
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

            ->add('save', SubmitType::class, array('label' => "J/'aime la bite" ))
            ->getForm();
        $res = $this->getData();
        return $this->render('FormGeneratorFormBundle:Default:form.html.twig',array(
            'form' => $form->createView(),
            'res'=>$res
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
