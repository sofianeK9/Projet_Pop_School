<?php

namespace App\Form;


use App\Entity\User;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('plainPassword', PasswordType::class, [
                // false car j'ai besoin de hasher le mdp manuellement avant de l'associer à l'entité
                'mapped' => false,
                // indique que le champ est destiné à la saisie d'un mdp
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire {{ limit }} caractéres',
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('confirmedPassword', PasswordType::class, [
                // false car j'ai besoin de hasher le mdp manuellement avant de l'associer à l'entité
                'mapped' => false,
                // indique que le champ est destiné à la saisie d'un mdp
                'attr' => ['autocomplete' => 'new-password'],
                'label' => 'Confirmez le mot de passe',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit faire {{ limit }} caractéres',
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('captcha', ReCaptchaType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
