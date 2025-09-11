<?php
// src/DataFixtures/ExerciseFixtures.php
namespace App\DataFixtures;

use App\Entity\Exercise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ExerciseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $exercises = [
            // CHEST
            [
                'name' => 'Bench Press',
                'description' => 'Lie on a bench and press a barbell up from chest level.',
                'muscleGroup' => 'Chest',
                'category' => 'Strength',
                'equipment' => 'Barbell'
            ],
            [
                'name' => 'Push-ups',
                'description' => 'Classic bodyweight exercise for chest, shoulders, and triceps.',
                'muscleGroup' => 'Chest',
                'category' => 'Bodyweight',
                'equipment' => 'None'
            ],
            [
                'name' => 'Incline Dumbbell Press',
                'description' => 'Dumbbell press on an inclined bench to target upper chest.',
                'muscleGroup' => 'Chest',
                'category' => 'Strength',
                'equipment' => 'Dumbbells'
            ],
            [
                'name' => 'Dumbbell Flyes',
                'description' => 'Isolation exercise for chest using dumbbells in a flying motion.',
                'muscleGroup' => 'Chest',
                'category' => 'Strength',
                'equipment' => 'Dumbbells'
            ],

            // BACK
            [
                'name' => 'Deadlift',
                'description' => 'Lift a barbell from the ground to hip level.',
                'muscleGroup' => 'Back',
                'category' => 'Strength',
                'equipment' => 'Barbell'
            ],
            [
                'name' => 'Pull-ups',
                'description' => 'Hang from a bar and pull yourself up until chin is over the bar.',
                'muscleGroup' => 'Back',
                'category' => 'Bodyweight',
                'equipment' => 'Pull-up Bar'
            ],
            [
                'name' => 'Bent Over Rows',
                'description' => 'Bend over and row a barbell to your chest.',
                'muscleGroup' => 'Back',
                'category' => 'Strength',
                'equipment' => 'Barbell'
            ],
            [
                'name' => 'Lat Pulldowns',
                'description' => 'Pull a cable bar down to your chest while seated.',
                'muscleGroup' => 'Back',
                'category' => 'Strength',
                'equipment' => 'Cable Machine'
            ],

            // LEGS
            [
                'name' => 'Squats',
                'description' => 'Lower your body by bending knees and hips, then return to standing.',
                'muscleGroup' => 'Legs',
                'category' => 'Strength',
                'equipment' => 'Barbell'
            ],
            [
                'name' => 'Lunges',
                'description' => 'Step forward and lower your body until both knees are bent at 90 degrees.',
                'muscleGroup' => 'Legs',
                'category' => 'Bodyweight',
                'equipment' => 'None'
            ],
            [
                'name' => 'Leg Press',
                'description' => 'Push weight with your legs while seated on a leg press machine.',
                'muscleGroup' => 'Legs',
                'category' => 'Strength',
                'equipment' => 'Machine'
            ],
            [
                'name' => 'Romanian Deadlift',
                'description' => 'Deadlift variation focusing on hamstrings and glutes.',
                'muscleGroup' => 'Legs',
                'category' => 'Strength',
                'equipment' => 'Barbell'
            ],
            [
                'name' => 'Calf Raises',
                'description' => 'Raise up on your toes to work your calf muscles.',
                'muscleGroup' => 'Legs',
                'category' => 'Strength',
                'equipment' => 'None'
            ],

            // SHOULDERS
            [
                'name' => 'Overhead Press',
                'description' => 'Press a barbell overhead from shoulder height.',
                'muscleGroup' => 'Shoulders',
                'category' => 'Strength',
                'equipment' => 'Barbell'
            ],
            [
                'name' => 'Lateral Raises',
                'description' => 'Raise dumbbells out to your sides to shoulder height.',
                'muscleGroup' => 'Shoulders',
                'category' => 'Strength',
                'equipment' => 'Dumbbells'
            ],
            [
                'name' => 'Front Raises',
                'description' => 'Raise dumbbells in front of you to shoulder height.',
                'muscleGroup' => 'Shoulders',
                'category' => 'Strength',
                'equipment' => 'Dumbbells'
            ],
            [
                'name' => 'Rear Delt Flyes',
                'description' => 'Bent over reverse fly motion to target rear deltoids.',
                'muscleGroup' => 'Shoulders',
                'category' => 'Strength',
                'equipment' => 'Dumbbells'
            ],

            // ARMS
            [
                'name' => 'Bicep Curls',
                'description' => 'Curl dumbbells up to your shoulders, focusing on biceps.',
                'muscleGroup' => 'Arms',
                'category' => 'Strength',
                'equipment' => 'Dumbbells'
            ],
            [
                'name' => 'Tricep Dips',
                'description' => 'Lower and raise your body using your arms on parallel bars or bench.',
                'muscleGroup' => 'Arms',
                'category' => 'Bodyweight',
                'equipment' => 'Bench'
            ],
            [
                'name' => 'Hammer Curls',
                'description' => 'Curl dumbbells with neutral grip to work biceps and forearms.',
                'muscleGroup' => 'Arms',
                'category' => 'Strength',
                'equipment' => 'Dumbbells'
            ],
            [
                'name' => 'Tricep Extensions',
                'description' => 'Extend arms overhead to work triceps.',
                'muscleGroup' => 'Arms',
                'category' => 'Strength',
                'equipment' => 'Dumbbells'
            ],

            // CORE
            [
                'name' => 'Plank',
                'description' => 'Hold your body in a straight line, supported by forearms and toes.',
                'muscleGroup' => 'Core',
                'category' => 'Bodyweight',
                'equipment' => 'None'
            ],
            [
                'name' => 'Crunches',
                'description' => 'Lie on your back and crunch your abs to lift shoulders off ground.',
                'muscleGroup' => 'Core',
                'category' => 'Bodyweight',
                'equipment' => 'None'
            ],
            [
                'name' => 'Russian Twists',
                'description' => 'Sit with knees bent and twist your torso side to side.',
                'muscleGroup' => 'Core',
                'category' => 'Bodyweight',
                'equipment' => 'None'
            ],
            [
                'name' => 'Mountain Climbers',
                'description' => 'In plank position, alternate bringing knees to chest rapidly.',
                'muscleGroup' => 'Core',
                'category' => 'Cardio',
                'equipment' => 'None'
            ],

            // CARDIO
            [
                'name' => 'Running',
                'description' => 'Outdoor or treadmill running for cardiovascular fitness.',
                'muscleGroup' => 'Cardio',
                'category' => 'Cardio',
                'equipment' => 'Treadmill'
            ],
            [
                'name' => 'Cycling',
                'description' => 'Stationary or road cycling for endurance and leg strength.',
                'muscleGroup' => 'Cardio',
                'category' => 'Cardio',
                'equipment' => 'Bike'
            ],
            [
                'name' => 'Rowing',
                'description' => 'Full body cardio exercise using rowing motion.',
                'muscleGroup' => 'Cardio',
                'category' => 'Cardio',
                'equipment' => 'Rowing Machine'
            ],
            [
                'name' => 'Jump Rope',
                'description' => 'Quick cardio exercise jumping over a rope.',
                'muscleGroup' => 'Cardio',
                'category' => 'Cardio',
                'equipment' => 'Jump Rope'
            ],
            [
                'name' => 'Burpees',
                'description' => 'Full body exercise combining squat, plank, and jump.',
                'muscleGroup' => 'Full Body',
                'category' => 'Cardio',
                'equipment' => 'None'
            ],
        ];

        foreach ($exercises as $exerciseData) {
            $exercise = new Exercise();
            $exercise->setName($exerciseData['name']);
            $exercise->setDescription($exerciseData['description']);
            $exercise->setMuscleGroup($exerciseData['muscleGroup']);
            $exercise->setCategory($exerciseData['category']);
            $exercise->setEquipment($exerciseData['equipment']);

            $manager->persist($exercise);
        }

        $manager->flush();
    }
}