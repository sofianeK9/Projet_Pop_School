<?php

namespace App\Form;

use App\Entity\DonneesAdministratives;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DonneesAdministrativesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lieuNaissance')
            ->add('email')
            ->add('paysNaissance')
            ->add('adresse')
            ->add('codePostal')
            ->add('commune')
            ->add('nationalite')
            ->add('situationProfessionnelle', ChoiceType::class, [
                'choices' =>  [
                    '' => '',
                    'RSA' => 'RSA',
                    'ARE' => 'ARE',
                    'Minima sociaux' => 'Minima sociaux',
                    'Travailleurs handicapés' => 'Travailleurs handicapés'
                ]
            ])
            ->add('numeroPoleEmploi')
            ->add('derniereClasseSuivie')
            ->add('dernierDiplomeObtenu');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DonneesAdministratives::class,
        ]);
    }
}
