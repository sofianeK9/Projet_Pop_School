<?php

namespace App\Form;

use App\Entity\Apprenant;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ApprenantType extends AbstractType
{
    // propriété privée
    private $passwordHasher;

    // constructeur afin d'initialiser la propriété de hashage de mdp
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        // initialisation de la proproété $passwordHasher avec l'interface UserPasswordHasherInterface
        $this->passwordHasher = $passwordHasher;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('genre', ChoiceType::class, [
                'choices' => [
                    'Féminin' => 'féminin',
                    'Masculin' => 'masculin',
                ],
                'placeholder' => 'Sélectionnez le genre',
                'attr' => [
                    'class' => 'place-holder'
                ]
            ])
            ->add('dateNaissance', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('telephone')
            ->add('consentement', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'label' => 'Consentement',
                'attr' => [
                    'class' => 'place-holder'
                ]

            ])
            ->add('user', UserType::class, [

                'label' => false
            ])
            ->add('donneesAdministratives', DonneesAdministrativesType::class, [
                'label' => false
            ])
            ->add('donneesPedagogiques', DonneesPedagogiquesType::class, [
                'label' => false
            ])
            ->add('promotion', null, [
                'attr' => [
                    'class' => 'place-holder'
                ]

            ])
            ->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
                $user = $event->getData()->getUser();
                $password = $user->getPassword();
                $hashedPassword = $this->passwordHasher->hashPassword($user, $password);
                $user->setPassword($hashedPassword);
            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Apprenant::class,
        ]);
    }
}
