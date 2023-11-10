<?php

namespace App\Form;

use App\Entity\DonneesPedagogiques;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DonneesPedagogiquesFormulairesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('compteGithub')
            ->add('compteDiscord')
            ->add('compteLinkedin')
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DonneesPedagogiques::class,
        ]);
    }
}
