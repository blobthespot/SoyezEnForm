<?php
/**
 * Created by PhpStorm.
 * User: Benoit
 * Date: 16/03/2017
 * Time: 14:54
 */

namespace FormGenerator\FormBundle\Models;


class Question
{
    private $Question;
    private $Responses;


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Tag::class,
        ));
    }

    /**
     * @return array
     */
    public function getResponses()
    {
        return $this->Responses;
    }
    /**
     * @param array $Responses
     */
    public function setResponses($Responses)
    {
        $this->Responses = $Responses;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->Question;
    }
    /**
     * @param mixed $Question
     */
    public function setQuestion($Question)
    {
        $this->Question = $Question;
    }



}