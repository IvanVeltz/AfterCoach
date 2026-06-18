<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\TrainingSession;
use Doctrine\ORM\EntityManagerInterface;

class TrainingSessionProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): TrainingSession
    {
        if (!$data instanceof TrainingSession) {
            throw new \LogicException('This processor only supports TrainingSession entities.');
        }

        $now = new \DateTimeImmutable();

        if ($data->getId() === null) {
            $data->setCreatedAt($now);
        }

        $data->setUpdatedAt($now);

        $this->entityManager->persist($data);
        $this->entityManager->flush();

        return $data;
    }
}