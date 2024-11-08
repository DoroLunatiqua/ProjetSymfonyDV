<?php

namespace App\Form;

use App\Entity\Patient;
use App\Entity\RealisationExoPatient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


// class RealisationExerciceType extends AbstractType
// {
    // public function buildForm(FormBuilderInterface $builder, array $options): void
    // {
    //     $builder
    //         ->add('date', null, [
    //             'widget' => 'single_text',
    //         ])
    //         ->add('feedback')
    //         ->add('resultat')
    //         ->add('patient', EntityType::class, [
    //             'class' => Patient::class,
    //             'choice_label' => 'id',
    //         ])
    //         ->add('question')
    //     ;
    // }

    // public function configureOptions(OptionsResolver $resolver): void
    // {
    //     $resolver->setDefaults([
    //         'data_class' => RealisationExoPatient::class,
    //     ]);
    // }

    class RealisationExerciceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Ajouter les champs habituels
        $builder
   
        ->add('feedback', TextareaType::class, [
            'label' => 'Feedback',
            'required' => true,
        ])
        ->add('resultat', TextareaType::class, [
            'label' => 'Votre réponse', 
            'required' => true,
        ])
        ->add('resultat2', TextareaType::class, [
            'label' => 'Votre réponse', 
            'required' => true,
        ])
        ->add('resultat3', TextareaType::class, [
            'label' => 'Votre réponse', 
            'required' => true,
        ])
        ->add('resultat4', TextareaType::class, [
            'label' => 'Votre réponse', 
            'required' => true,
        ])
        ->add('resultat5', TextareaType::class, [
            'label' => 'Votre réponse', 
            'required' => true,
        ]);
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RealisationExoPatient::class,
        ]);
    }
}
