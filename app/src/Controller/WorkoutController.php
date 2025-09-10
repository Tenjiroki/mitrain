<?php
namespace App\Controller;

use App\Entity\ExerciseSet;
use App\Entity\Workout;
use App\Entity\WorkoutExercise;
use App\Form\WorkoutType;
use App\Repository\WorkoutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/workout')]
#[IsGranted('ROLE_USER')]
class WorkoutController extends AbstractController
{
    #[Route('/workout/', name: 'workout_index', methods: ['GET'])]
    public function index(WorkoutRepository $workoutRepository): Response
    {
        $workouts = $workoutRepository->findBy(
            ['user' => $this->getUser()],
            ['date' => 'DESC']
        );

        return $this->render('workout/index.html.twig', [
            'workouts' => $workouts,
        ]);
    }

    #[Route('/workout/new', name: 'workout_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $workout = new Workout();
        $workout->setUser($this->getUser());
        $workout->setDate(new \DateTime());

        // Add one empty exercise with one empty set to start
        $workoutExercise = new WorkoutExercise();
        $workoutExercise->setOrderInWorkout(1);
        
        $exerciseSet = new ExerciseSet();
        $exerciseSet->setSetNumber(1);
        $exerciseSet->setCompleted(false);
        
        $workoutExercise->addSet($exerciseSet);
        $workout->addWorkoutExercise($workoutExercise);

        $form = $this->createForm(WorkoutType::class, $workout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Set proper order and set numbers
            $this->processWorkoutData($workout);
            
            $entityManager->persist($workout);
            $entityManager->flush();

            $this->addFlash('success', 'Workout created successfully!');

            return $this->redirectToRoute('workout_show', ['id' => $workout->getId()]);
        }

        return $this->render('workout/new.html.twig', [
            'workout' => $workout,
            'form' => $form,
        ]);
    }

    #[Route('/workout/{id}', name: 'workout_show', methods: ['GET'])]
    public function show(Workout $workout): Response
    {
        // Check if user owns this workout
        if ($workout->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        return $this->render('workout/show.html.twig', [
            'workout' => $workout,
        ]);
    }

    #[Route('/workout/{id}/edit', name: 'workout_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Workout $workout, EntityManagerInterface $entityManager): Response
    {
        // Check if user owns this workout
        if ($workout->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(WorkoutType::class, $workout);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Set proper order and set numbers
            $this->processWorkoutData($workout);
            
            $entityManager->flush();

            $this->addFlash('success', 'Workout updated successfully!');

            return $this->redirectToRoute('workout_show', ['id' => $workout->getId()]);
        }

        return $this->render('workout/edit.html.twig', [
            'workout' => $workout,
            'form' => $form,
        ]);
    }

    #[Route('/workout/{id}', name: 'workout_delete', methods: ['POST'])]
    public function delete(Request $request, Workout $workout, EntityManagerInterface $entityManager): Response
    {
        // Check if user owns this workout
        if ($workout->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        if ($this->isCsrfTokenValid('delete'.$workout->getId(), $request->request->get('_token'))) {
            $entityManager->remove($workout);
            $entityManager->flush();
            
            $this->addFlash('success', 'Workout deleted successfully!');
        }

        return $this->redirectToRoute('workout_index');
    }

    private function processWorkoutData(Workout $workout): void
    {
        $exerciseOrder = 1;
        
        foreach ($workout->getWorkoutExercises() as $workoutExercise) {
            $workoutExercise->setOrderInWorkout($exerciseOrder++);
            
            $setNumber = 1;
            foreach ($workoutExercise->getSets() as $set) {
                $set->setSetNumber($setNumber++);
                
                // Set default completed to false if not set
                if ($set->isCompleted() === null) {
                    $set->setCompleted(false);
                }
            }
        }
    }
}