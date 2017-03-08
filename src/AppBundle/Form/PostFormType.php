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
            ->add('title', TextType::class)
            ->add('price', TextType::class)
            ->add('artist', EntityType::class, [
                // This wil be change depending on the value
                'mapped' => false,
                'property_path' => 'artist',
                'empty_value'=>'Choose Artist',
                'class'=>Artist::class,
                'choice_label'=>'artist',
                'query_builder'=> function (EntityRepository $er) {
                    return $er->createQueryBuilder('artist')
                        ->orderBy('artist.artist', 'ASC');
                },
            ])
            // For now just display the embed form, will be hidden later
            ->add('artist_form', ArtistType::class, array(
                // This wil be change depending on the value
                'mapped' => false,
                'property_path' => 'artist',
            ))
            ->add('description', TextareaType::class)
            ->add('purchaseDate','date')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Post'
        ]);
    }
}
