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

class SetImageFormType extends AbstractType
{
    private $postId;

    public function __construct($postId=null)
    {
        $this->postId = $postId;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('imageId',HiddenType::class)
            ->add('showDefault',HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Image',
        ]);
    }
}
