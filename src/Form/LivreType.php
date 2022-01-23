<?php

namespace App\Form;

use App\Entity\Livre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isbn', TextType::class, [
                'attr' => [
                    
                    'placeholder' => 'Entrez l\' ISBN'
                ]
            ])
            ->add('titre', TextType::class, [
                'attr' => [
                   
                    'placeholder' => 'Entrez le titre du bouquint'
                ]
            ])
            ->add('nombre_pages', null, [
                'attr' => [
                   
                    'placeholder' => 'Entrez le nombre de page'
                ]
            ])
            ->add('date_de_parution', DateType::class, [
                'widget' => 'single_text',
                
            ])
            ->add('note')
            ->add('auteurs', null,[
                'attr' => [
                    'multiple' => true
                ]
            ])
            ->add('genres', null,[
                'attr' => [
                    'multiple' => true
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
