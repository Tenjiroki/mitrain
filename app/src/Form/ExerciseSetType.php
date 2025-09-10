<?php

namespace App\Form;

use App\Entity\ExerciseSet;
use App\Entity\WorkoutExercise;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExerciseSetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('setNumber')
            ->add('reps')
            ->add('weight')
            ->add('duration')
            ->add('distance')
            ->add('completed')
            ->add('workoutExercise', EntityType::class, [
                'class' => WorkoutExercise::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ExerciseSet::class,
        ]);
    }
}
