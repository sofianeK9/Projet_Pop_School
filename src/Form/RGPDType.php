<?php

namespace App\Form;

use App\Entity\Apprenant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RGPDType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('consentement', CheckboxType::class, [
            'label' => '<span style="font-weight:bold;">J\'accepte la collecte de mes données</span>',
            'label_html' => true,  
            'required' => true,
            'invalid_message' => 'Vous devez accepter la collecte de données pour continuer.',
            'label_attr' => [
                'style' => 'margin-right: 10px; font-size: 20px;',  
            ],
            'attr' => [
                'style' => 'font-size: 16px;',  
            ],
        ]);
}


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Apprenant::class,
        ]);
    }
}
