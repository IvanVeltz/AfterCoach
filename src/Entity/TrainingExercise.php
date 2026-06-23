<?php

namespace App\Entity;

use App\Repository\TrainingExerciseRepository;
use App\Enum\ExerciseType;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainingExerciseRepository::class)]
class TrainingExercise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(enumType: ExerciseType::class)]
    private ?ExerciseType $exerciseType = null;

    #[ORM\Column]
    private ?int $position = null;

    #[ORM\Column(nullable: true)]
    private ?int $duration = null;

    #[ORM\Column(nullable: true)]
    private ?float $distance = null;

    #[ORM\Column(nullable: true)]
    private ?int $repetitions = null;

    #[ORM\Column(nullable: true)]
    private ?int $targetPaceSeconds = null;

    #[ORM\Column(nullable: true)]
    private ?int $recoveryDuration = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;
    
    #[ORM\ManyToOne(inversedBy: 'trainingExercises')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TrainingSession $trainingSession = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getExerciseType(): ?ExerciseType
    {
        return $this->exerciseType;
    }

    public function setExerciseType(?ExerciseType $exerciseType): static
    {
        $this->exerciseType = $exerciseType;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;

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

    public function getRepetitions(): ?int
    {
        return $this->repetitions;
    }

    public function setRepetitions(?int $repetitions): static
    {
        $this->repetitions = $repetitions;

        return $this;
    }

    public function getTargetPaceSeconds(): ?int
    {
        return $this->targetPaceSeconds;
    }

    public function setTargetPaceSeconds(?int $targetPaceSeconds): static
    {
        $this->targetPaceSeconds = $targetPaceSeconds;

        return $this;
    }

    public function getRecoveryDuration(): ?int
    {
        return $this->recoveryDuration;
    }

    public function setRecoveryDuration(?int $recoveryDuration): static
    {
        $this->recoveryDuration = $recoveryDuration;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getTrainingSession(): ?TrainingSession
    {
        return $this->trainingSession;
    }

    public function setTrainingSession(?TrainingSession $trainingSession): static
    {
        $this->trainingSession = $trainingSession;

        return $this;
    }
}
