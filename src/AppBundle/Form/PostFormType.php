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
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
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
                'required' => false,
                'property_path' => 'artist',
                'empty_value'=>'Choose Artist',
                'class'=>Artist::class,
                'choice_label'=>'artist',
                'query_builder'=> function (EntityRepository $er) {
                    $list_artist = $er->createQueryBuilder('artist')
                        ->orderBy('artist.artist', 'ASC')
                    ;
                    return $list_artist;
                },
            ])
            // For now just display the embed form, will be hidden later
            ->add('artist_form', ArtistType::class, array(
                // This wil be change depending on the value
                'mapped' => false,
                'required' => false,
                'property_path' => 'artist',
            ))
            ->add('description', TextareaType::class)
            ->add('purchaseDate','date')
        ;

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $user_data = $event->getData();
            $form = $event->getForm();
            $artist_field = empty($user_data['artist'])? 'artist_form' : 'artist';
            $config = $form->get($artist_field)->getConfig();
            $options = $config->getOptions();
            $options['mapped'] = true;
            $options['required'] = true;
            $form->add($artist_field, $config->getType()->getName(), $options);
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Post'
        ]);
    }
}
