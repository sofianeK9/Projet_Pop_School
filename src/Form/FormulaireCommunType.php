<?php

namespace App\Form;

use App\Entity\Apprenant;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormulaireCommunType extends AbstractType
{
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
            ->add('promotion')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Apprenant::class,
        ]);
    }
}
