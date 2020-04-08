<?php

namespace App\Form;

use App\Entity\Rcategorie;
use App\Entity\Recette;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class RecetteType extends AbstractType
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
            ->add('speciality', ChoiceType::class,[
                'label' => 'Selectionner une spécialité',
                'choices'=>[
                    'Africain' => 'Africain',
                    'Europeen' => 'Europeen',
                    'Asiatique' => 'Asiatique',
                    'Générale' => 'Générale',
                    ]
            ])
            ->add('link', TextType::class,[
                'label' => 'Lien',
                'required'=> false
            ])
            ->add('rcategorie',EntityType::class,[
                'label' => 'Selectionner une categorie',
                'class' => Rcategorie::class,
                'choice_label' => 'name',
            ])
            ->add('image', FileType::class, array(
                'data_class' => null,
                'label' => 'Image',
                'required'=> false
            ))
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
            'data_class' => Recette::class,
        ]);
    }
}
