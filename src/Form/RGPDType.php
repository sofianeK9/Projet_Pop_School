<?php

namespace App\Form;

use App\Entity\Apprenant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RGPDType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

        ->add('consentement', ChoiceType::class, [
            'choices' => [
                'Oui' => true,
                'Non' => false,
            ],
            'expanded' => true, 
                'multiple' => false, 
                'label' => false, 
                'required' => true,
        ]);
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Apprenant::class,
        ]);
    }
}
