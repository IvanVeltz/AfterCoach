<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\TrainingSession;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class TrainingSessionProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly Security $security,
    ) {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): TrainingSession
    {
        if (!$data instanceof TrainingSession) {
            throw new \LogicException('This processor only supports TrainingSession entities.');
        }

        $user = $this->security->getUser();

        $athlete = $data->getAthlete();

        if ($athlete === null) {
            throw new AccessDeniedHttpException('Athlete is required.');
        }

        if ($athlete->getCoach() !== $user) {
            throw new AccessDeniedHttpException('You cannot create a session for this athlete.');
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