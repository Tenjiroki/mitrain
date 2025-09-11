<?php
namespace App\Form;

use App\Entity\Exercise;
use App\Entity\WorkoutExercise;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkoutExerciseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('exercise', EntityType::class, [
                'class' => Exercise::class,
                'choice_label' => 'name',
                'placeholder' => 'Choose an exercise',
                'label' => 'Exercise',
                'attr' => ['class' => 'form-select']
            ])
            ->add('orderInWorkout', HiddenType::class)
            ->add('notes', TextareaType::class, [
                'required' => false,
                'label' => 'Exercise Notes',
                'attr' => [
                    'rows' => 2, 
                    'placeholder' => 'Notes',
                    'class' => 'form-control'
                ]
            ])
            ->add('sets', CollectionType::class, [
                'entry_type' => ExerciseSetType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'label' => false,
                'attr' => ['class' => 'exercise-sets-collection']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WorkoutExercise::class,
        ]);
    }
}