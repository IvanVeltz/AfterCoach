<?php

namespace App\Entity;

use App\Repository\CompletedSessionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
    normalizationContext: ['groups' => ['completed_session:read']],
    denormalizationContext: ['groups' => ['completed_session:write']],
    security: "is_granted('ROLE_COACH')"
)]
#[ORM\Entity(repositoryClass: CompletedSessionRepository::class)]
class CompletedSession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['completed_session:read'])]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['completed_session:read', 'completed_session:write'])]
    private ?float $actualDistance = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['completed_session:read', 'completed_session:write'])]
    private ?int $actualDuration = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['completed_session:read', 'completed_session:write'])]
    private ?string $athleteComment = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['completed_session:read', 'completed_session:write'])]
    private ?\DateTimeImmutable $completedAt = null;

    #[ORM\Column]
    #[Groups(['completed_session:read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Groups(['completed_session:read'])]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToOne(inversedBy: 'completedSession')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['completed_session:read', 'completed_session:write'])]
    private ?TrainingSession $trainingSession = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActualDistance(): ?float
    {
        return $this->actualDistance;
    }

    public function setActualDistance(?float $actualDistance): static
    {
        $this->actualDistance = $actualDistance;

        return $this;
    }

    public function getActualDuration(): ?int
    {
        return $this->actualDuration;
    }

    public function setActualDuration(?int $actualDuration): static
    {
        $this->actualDuration = $actualDuration;

        return $this;
    }

    public function getAthleteComment(): ?string
    {
        return $this->athleteComment;
    }

    public function setAthleteComment(?string $athleteComment): static
    {
        $this->athleteComment = $athleteComment;

        return $this;
    }

    public function getCompletedAt(): ?\DateTimeImmutable
    {
        return $this->completedAt;
    }

    public function setCompletedAt(?\DateTimeImmutable $completedAt): static
    {
        $this->completedAt = $completedAt;

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
