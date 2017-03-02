<?php

namespace AppBundle\Form;


use AppBundle\Entity\Artist;
use AppBundle\Entity\Post;
use Doctrine\ORM\EntityRepository;
use AppBundle\Repository\ArtistRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class PostFormType extends AbstractType
{
    private $userId;

    public function __construct($userId=null)
    {
        $this->userId = $userId;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title', TextType::class, array( 'attr' => array(
                'class' => 'form-control'
            )))
            ->add('price', TextType::class, array( 'attr' => array(
                'class' => 'form-control'
            )))
            ->add('artist', EntityType::class, [
                'placeholder'=>'Choose Artist',
                'class'=>Artist::class,
                'data'=>3,
                'choice_label'=>'artist',
                'query_builder'=> function (EntityRepository $er) {
                    return $er->createQueryBuilder('artist')
                        ->orderBy('artist.artist', 'ASC');
                },

                'empty_data'  => null,
                'attr' => array(
                    'class' => 'form-control'
                )
            ])

            ->add('userId', HiddenType::class )
            ->add('description', TextareaType::class, array( 'attr' => array(
                'class' => 'form-control'
            )))
            ->add('purchaseDate','date')
            ->add('id',HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Post'
        ]);
    }
}
