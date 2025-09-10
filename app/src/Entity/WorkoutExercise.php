<?php

namespace App\Entity;

use App\Repository\WorkoutExerciseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WorkoutExerciseRepository::class)]
class WorkoutExercise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'workoutExercises')]
    private ?Workout $workout = null;

    #[ORM\ManyToOne]
    private ?Exercise $exercise = null;

    #[ORM\Column]
    private ?int $orderInWorkout = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    /**
     * @var Collection<int, ExerciseSet>
     */
    #[ORM\OneToMany(targetEntity: ExerciseSet::class, mappedBy: 'workoutExercise')]
    private Collection $sets;

    public function __construct()
    {
        $this->sets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWorkout(): ?Workout
    {
        return $this->workout;
    }

    public function setWorkout(?Workout $workout): static
    {
        $this->workout = $workout;

        return $this;
    }

    public function getExercise(): ?Exercise
    {
        return $this->exercise;
    }

    public function setExercise(?Exercise $exercise): static
    {
        $this->exercise = $exercise;

        return $this;
    }

    public function getOrderInWorkout(): ?int
    {
        return $this->orderInWorkout;
    }

    public function setOrderInWorkout(int $orderInWorkout): static
    {
        $this->orderInWorkout = $orderInWorkout;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * @return Collection<int, ExerciseSet>
     */
    public function getSets(): Collection
    {
        return $this->sets;
    }

    public function addSet(ExerciseSet $set): static
    {
        if (!$this->sets->contains($set)) {
            $this->sets->add($set);
            $set->setWorkoutExercise($this);
        }

        return $this;
    }

    public function removeSet(ExerciseSet $set): static
    {
        if ($this->sets->removeElement($set)) {
            // set the owning side to null (unless already changed)
            if ($set->getWorkoutExercise() === $this) {
                $set->setWorkoutExercise(null);
            }
        }

        return $this;
    }
}
