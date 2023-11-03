<?php

namespace App\Form;

use App\Entity\Apprenant;
use App\Entity\DonneesPedagogiques;
use App\Entity\User;
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
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
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
            ])
            ->add('dateNaissance', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('telephone')
            ->add('consentement')
            ->add('user', UserType::class, [
                'label_attr' => [
                    'class' => 'd-none',
                ]
            ])
            ->add('donneesAdministratives', DonneesAdministrativesType::class, [
                'label_attr' => [
                    'class' => 'd-none',
                ]
            ])
            ->add('donneesPedagogiques', DonneesPedagogiquesType::class, [
                'label_attr' => [
                    'class' => 'd-none'
                ]
            ])
            ->add('promotion')
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
