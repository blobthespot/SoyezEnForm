<?php

namespace FormGenerator\FormBundle\Form;

use Symfony\Component\Form\AbstractType;
<<<<<<< HEAD
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
=======
>>>>>>> 7d5582e4403cf407969f8095d5c7fe88f6dddb6a
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
<<<<<<< HEAD
        $builder
            ->add('question')
            ->add('isMultiple')
            ->add('answers', CollectionType::class, array(
                'entry_type'   => AnswerType::class,
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype'    => true
            ));

    }
=======
        $builder->add('question')->add('topicId')->add('isMultiple');
    }
    
>>>>>>> 7d5582e4403cf407969f8095d5c7fe88f6dddb6a
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FormGenerator\FormBundle\Entity\Question'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'formgenerator_formbundle_question';
    }


}
