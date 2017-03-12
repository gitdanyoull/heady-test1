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
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
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
            ->add('price', MoneyType::class, array(
                    'currency' => 'USD',
                    'grouping' => true
            ))
            ->add('artist', EntityType::class, [
                // This wil be change depending on the value
                'mapped' => true,
                'required' => true,
                'property_path' => 'artist',
                'empty_value'=>'New Artist',
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
                'data' => null,
                'property_path' => 'artist',
            ))
            ->add('description', TextareaType::class)
            ->add('purchaseDate','date')
        ;

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $user_data = $event->getData();
            $form = $event->getForm();
            if(empty($user_data['artist'])) {
                $this->_switchArtistField('artist', false, $form);
                $this->_switchArtistField('artist_form', true, $form);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Post'
        ]);
    }

    private function _switchArtistField($field, $active, $form) {
        $config = $form->get($field)->getConfig();
        $options = $config->getOptions();
        $options['mapped'] = $active;
        $options['required'] = $active;
        $form->add($field, $config->getType()->getName(), $options);
    }
}
