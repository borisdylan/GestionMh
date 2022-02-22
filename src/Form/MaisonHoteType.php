<?php

namespace App\Form;

use App\Entity\MaisonHote;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaisonHoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom',TextType::class,[
                'label' => 'Emplacement',
                'attr'  =>[
                    'placeholder' =>"Insérer l'emplacement", 'class' =>'emplacement'
                ]
                ])    
                
                
                ->add('Nom',TextType::class,[
                    'label' => 'Nom',
                    'attr'  =>[
                        'placeholder' =>'Insérer le nom', 'class' =>'Nom'
                    ]
                    ])


            ->add('Prixnuit',NumberType::class,[
                'label' => 'Prixnuit',
                'attr'  =>[
                    'placeholder' =>'Insérer le prix', 'class' =>'Prixnuit'
                ]
            ])            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MaisonHote::class,
        ]);
    }
}
