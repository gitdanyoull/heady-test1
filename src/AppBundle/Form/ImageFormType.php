<?php

namespace AppBundle\Form;


use AppBundle\Entity\Image;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ImageFormType extends AbstractType
{
    private $postId;

    public function __construct($postId=null)
    {
        $this->postId = $postId;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name','text', array( 'attr' => array(
                'class' => 'form-control',
                'required' => 'false'
            )))
            ->add('postId', HiddenType::class, array(
                'data' => $this->postId
            ))
            ->add('file','file', array( 'attr' => array(
            )))
            ->add('note','textarea',array( 'attr' => array(
                'class' => 'form-control',
                'required' => 'false'
            )))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Image',
            'csrf_protection' => false
        ]);
    }
}
