<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Athlete;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;

class AthleteProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly Security $security
    ) {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): Athlete
    {
        if (!$data instanceof Athlete) {
            throw new \LogicException('This processor only supports Athlete entities.');
        }

        $now = new \DateTimeImmutable();

        if ($data->getId() === null) {
            $data->setCoach($this->security->getUser());
            $data->setCreatedAt($now);
        }

        $data->setUpdatedAt($now);

        $this->entityManager->persist($data);
        $this->entityManager->flush();

        return $data;
    }
}