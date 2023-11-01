<?php

namespace App\Form;

use App\Entity\Apprenant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApprenantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('genre')
            ->add('dateNaissance')
            ->add('telephone')
            ->add('consentement')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('deletedAt')
            ->add('user')
            ->add('donneesAdministratives')
            ->add('donneesPedagogiques')
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
