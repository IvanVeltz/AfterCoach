<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TrainingSessionRepository;
use App\State\TrainingSessionProcessor;
use App\State\TrainingSessionProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    provider: TrainingSessionProvider::class,
    processor: TrainingSessionProcessor::class,
    normalizationContext: ['groups' => ['training_session:read']],
    denormalizationContext: ['groups' => ['training_session:write']],
    security: "is_granted('ROLE_COACH')"
)]
#[ORM\Entity(repositoryClass: TrainingSessionRepository::class)]
class TrainingSession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['training_session:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    #[Groups(['training_session:read', 'training_session:write'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['training_session:read', 'training_session:write'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['training_session:read', 'training_session:write'])]
    private ?\DateTimeImmutable $scheduledDate = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['training_session:read', 'training_session:write'])]
    private ?float $plannedDistance = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['training_session:read', 'training_session:write'])]
    private ?int $plannedDuration = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['training_session:read', 'training_session:write'])]
    private ?string $coachComment = null;

    #[ORM\Column]
    #[Groups(['training_session:read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Groups(['training_session:read'])]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'trainingSessions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['training_session:read', 'training_session:write'])]
    private ?Athlete $athlete = null;

    #[ORM\ManyToOne(inversedBy: 'trainingSessions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['training_session:read', 'training_session:write'])]
    private ?TrainingType $type = null;

    #[ORM\OneToOne(mappedBy: 'trainingSession', cascade: ['persist'])]
    private ?CompletedSession $completedSession = null;

    /**
     * @var Collection<int, TrainingExercise>
     */
    #[ORM\OneToMany(
        targetEntity: TrainingExercise::class,
        mappedBy: 'trainingSession',
        orphanRemoval: true
    )]
    private Collection $trainingExercises;

    public function __construct()
    {
        $this->trainingExercises = new ArrayCollection();
    } 

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

    public function getScheduledDate(): ?\DateTimeImmutable
    {
        return $this->scheduledDate;
    }

    public function setScheduledDate(\DateTimeImmutable $scheduledDate): static
    {
        $this->scheduledDate = $scheduledDate;

        return $this;
    }

    public function getPlannedDistance(): ?float
    {
        return $this->plannedDistance;
    }

    public function setPlannedDistance(?float $plannedDistance): static
    {
        $this->plannedDistance = $plannedDistance;

        return $this;
    }

    public function getPlannedDuration(): ?int
    {
        return $this->plannedDuration;
    }

    public function setPlannedDuration(?int $plannedDuration): static
    {
        $this->plannedDuration = $plannedDuration;

        return $this;
    }

    public function getCoachComment(): ?string
    {
        return $this->coachComment;
    }

    public function setCoachComment(?string $coachComment): static
    {
        $this->coachComment = $coachComment;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getAthlete(): ?Athlete
    {
        return $this->athlete;
    }

    public function setAthlete(?Athlete $athlete): static
    {
        $this->athlete = $athlete;

        return $this;
    }

    public function getType(): ?TrainingType
    {
        return $this->type;
    }

    public function setType(?TrainingType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getCompletedSession(): ?CompletedSession
    {
        return $this->completedSession;
    }

    public function setCompletedSession(CompletedSession $completedSession): static
    {
        if ($completedSession->getTrainingSession() !== $this) {
            $completedSession->setTrainingSession($this);
        }

        $this->completedSession = $completedSession;

        return $this;
    }

    /**
     * @return Collection<int, TrainingExercise>
     */
    public function getTrainingExercises(): Collection
    {
        return $this->trainingExercises;
    }

    public function addTrainingExercise(TrainingExercise $trainingExercise): static
    {
        if (!$this->trainingExercises->contains($trainingExercise)) {
            $this->trainingExercises->add($trainingExercise);
            $trainingExercise->setTrainingSession($this);
        }

        return $this;
    }

    public function removeTrainingExercise(TrainingExercise $trainingExercise): static
    {
        if ($this->trainingExercises->removeElement($trainingExercise)) {
            // set the owning side to null (unless already changed)
            if ($trainingExercise->getTrainingSession() === $this) {
                $trainingExercise->setTrainingSession(null);
            }
        }

        return $this;
    }
}
