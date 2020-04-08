<?php

namespace App\Form;

use App\Entity\Ccategorie;
use App\Entity\Conseil;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConseilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'label' => 'Nom '
            ])
            ->add('description', TextareaType::class,[
                'label' => 'Description'
            ])
            ->add('ccategorie',EntityType::class,[
                'label' => 'Selectionner une categorie',
                'class' => Ccategorie::class,
                'choice_label' => 'name',
            ])

            //->add('createdAt')
            //->add('createdBy')
            ->add('submit', SubmitType::class,[
                'label'=>'Enregistrer',

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Conseil::class,
        ]);
    }
}
