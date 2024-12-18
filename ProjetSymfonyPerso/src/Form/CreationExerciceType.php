<?php

namespace App\Form;

use App\Entity\Exercice;
use App\Enum\ThemeExo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreationExerciceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('themeExo', EnumType::class, [
                'class' => ThemeExo::class
            ])
            ->add('question', TextType::class)
            ->add('question2', TextType::class)
            ->add('question3', TextType::class)
            ->add('question4', TextType::class)
            ->add('question5', TextType::class)
            // ->add('reponse', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercice::class,
        ]);
    }
}
