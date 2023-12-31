<?php

namespace App\Form;

use App\Entity\Apprenant;
use App\Entity\Promotion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromotionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('createdAt', DateType::class, [
                'widget' => 'single_text',
                'required' => true
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
                'required' => true
            ])
            ->add('apprenants', EntityType::class, [
                'class' => Apprenant::class,
                'choice_label' => function (apprenant $apprenant) {
                    return "{$apprenant->getNom()}{$apprenant->getPrenom()}";
                },
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'form_scrollable-checkboxes',
                ],
                'by_reference' => false,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                    ->orderBy('p.nom','ASC'); 
                },
                
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Promotion::class,
        ]);
    }
}
