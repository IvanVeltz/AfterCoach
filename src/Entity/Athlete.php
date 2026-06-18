<?php

namespace App\Entity;

use App\Repository\AthleteRepository;
use App\State\AthleteProcessor;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    processor: AthleteProcessor::class,
    normalizationContext: ['groups' => ['athlete:read']],
    denormalizationContext: ['groups' => ['athlete:write']]
)]
#[ORM\Entity(repositoryClass: AthleteRepository::class)]
class Athlete
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['athlete:read'])]
    private ?int $id = null;

    #[Groups(['athlete:read', 'athlete:write'])]
    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[Groups(['athlete:read', 'athlete:write'])]
    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[Groups(['athlete:read', 'athlete:write'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[Groups(['athlete:read', 'athlete:write'])]
    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $dateOfBirth = null;

    #[Groups(['athlete:read', 'athlete:write'])]
    #[ORM\Column(length: 20)]
    private ?string $gender = null;

    #[Groups(['athlete:read', 'athlete:write'])]
    #[ORM\Column(nullable: true)]
    private ?float $weight = null;

    #[Groups(['athlete:read', 'athlete:write'])]
    #[ORM\Column(nullable: true)]
    private ?int $height = null;

        
    #[Groups(['athlete:read', 'athlete:write'])]
    #[ORM\Column(length: 20, nullable: true)]
    private ?string $phone = null;

    #[Groups(['athlete:read', 'athlete:write'])]
    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'athletes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $coach = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeImmutable
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeImmutable $dateOfBirth): static
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): static
    {
        $this->gender = $gender;

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

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

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

    public function getCoach(): ?User
    {
        return $this->coach;
    }

    public function setCoach(?User $coach): static
    {
        $this->coach = $coach;

        return $this;
    }
}
