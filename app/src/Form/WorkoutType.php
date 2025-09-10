<?php

namespace App\Form;

use App\Entity\Workout;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Workout Name',
                'attr' => ['placeholder' => 'Enter workout name']
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Workout Date'
            ])
            ->add('notes', TextareaType::class, [
                'required' => false,
                'label' => 'Notes',
                'attr' => ['rows' => 3, 'placeholder' => 'Notes here']
            ])
            ->add('workoutExercises', CollectionType::class, [
                'entry_type' => WorkoutExerciseType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'label' => false,
                'attr' => ['class' => 'workout-exercise-collection']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Workout::class,
        ]);
    }
}
