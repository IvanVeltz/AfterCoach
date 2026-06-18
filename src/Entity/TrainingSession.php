<?php

namespace App\Entity;

use App\Repository\TrainingSessionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrainingSessionRepository::class)]
class TrainingSession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $scheduledDate = null;

    #[ORM\Column(nullable: true)]
    private ?float $plannedDistance = null;

    #[ORM\Column(nullable: true)]
    private ?int $plannedDuration = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $coachComment = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'trainingSessions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Athlete $athlete = null;

    #[ORM\ManyToOne(inversedBy: 'trainingSessions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TrainingType $type = null;

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

    public function setPlannedDistance(float $plannedDistance): static
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
}
