<?php

namespace App\Form;

use App\Entity\ExerciseSet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExerciseSetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('setNumber', HiddenType::class)
            ->add('reps', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Reps', 
                    'min' => 0,
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('weight', NumberType::class, [
                'required' => false,
                'label' => false,
                'scale' => 2,
                'attr' => [
                    'placeholder' => 'Weight', 
                    'step' => '0.25', 
                    'min' => 0,
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('duration', IntegerType::class,[
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Duration (sec)', 
                    'min' => 0,
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('distance', NumberType::class, [
                'required' => false,
                'label' => false,
                'scale' => 2,
                'attr' => [
                    'placeholder' => 'Distance', 
                    'step' => '0.1', 
                    'min' => 0,
                    'class' => 'form-control form-control-sm'
                ]
            ])
            ->add('completed', CheckboxType::class,[
                'required' => false,
                'label' => '✓',
                'attr' => [
                    'class' => 'form-check-input'
                ]
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