<?php

namespace AppBundle\Form;


use AppBundle\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class MessageFormType extends AbstractType
{
    private $postId;

    public function __construct($postId=null)
    {
        $this->postId = $postId;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title', 'text', array( 'attr' => array(
        'class' => 'form-control'
            )))
            ->add('message', 'textarea', array( 'attr' => array(
                'class' => 'form-control'
            )))
            ->add('rating',HiddenType::class,  array(
                'data' => '',
            ))
            ->add('tstamp',HiddenType::class, array(
                'data' => time(),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Message'
        ]);
    }
}
