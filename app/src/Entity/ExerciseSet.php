<?php

namespace App\Entity;

use App\Repository\ExerciseSetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciseSetRepository::class)]
class ExerciseSet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'sets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?WorkoutExercise $workoutExercise = null;

    #[ORM\Column]
    private ?int $setNumber = null;

    #[ORM\Column(nullable: true)]
    private ?int $reps = null; 

    #[ORM\Column(nullable: true)]
    private ?float $weight = null;

    #[ORM\Column(nullable: true)]
    private ?int $duration = null;

    #[ORM\Column(nullable: true)]
    private ?float $distance = null;

    #[ORM\Column(nullable: true)]
    private ?bool $completed = null; 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWorkoutExercise(): ?WorkoutExercise
    {
        return $this->workoutExercise;
    }

    public function setWorkoutExercise(?WorkoutExercise $workoutExercise): static
    {
        $this->workoutExercise = $workoutExercise;

        return $this;
    }

    public function getSetsNumber(): ?int
    {
        return $this->setNumber;
    }

    public function setSetsNumber(int $setsNumber): static
    {
        $this->setNumber = $setsNumber;

        return $this;
    }

    public function getReps(): ?int
    {
        return $this->reps;
    }

    public function setReps(int $reps): static
    {
        $this->reps = $reps;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(?float $distance): static
    {
        $this->distance = $distance;

        return $this;
    }

    public function isCompleted(): ?bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): static
    {
        $this->completed = $completed;

        return $this;
    }
}
