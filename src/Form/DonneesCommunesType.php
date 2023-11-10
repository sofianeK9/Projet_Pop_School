<?php

namespace App\Form;

use App\Entity\Apprenant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DonneesCommunesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('genre')
            ->add('dateNaissance')
            ->add('telephone')
            ->add('consentement', ChoiceType::class, [
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'label' => 'Consentement',
            ])
            ->add('donneesAdministratives', DonneesAdministrativesType::class, [
                'label_attr' => [
                    'class' => 'd-none'
                ]
            ])
            ->add('donneesPedagogiques', DonneesPedagogiquesFormulairesType::class, [
                'label_attr' => [
                    'class' => 'd-none'
                ]
            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Apprenant::class,
        ]);
    }
}
