<?php

namespace App\Form;

use App\Entity\Astuce;
use App\Entity\Ccategorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AstuceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder




            ->add('name',TextType::class,[
                'label' => 'Nom '
            ])
            ->add('type', ChoiceType::class,[
                'label' => 'Selectionner un type astuces',
                'choices'=>[
                    'Beauté' => 'Beauté',
                    'Santé' => 'Santé',
                    'Sport' => 'Sport',
                    'Nouriture' => 'Nouriture',
                ]
            ])
            ->add('description', TextareaType::class,[
                'label' => 'Description'
            ])

            ->add('submit', SubmitType::class,[
                'label'=>'Enregistrer',

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Astuce::class,
        ]);
    }
}
