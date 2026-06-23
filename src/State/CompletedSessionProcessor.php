<?php

namespace App\State;

use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\CompletedSession;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CompletedSessionProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly Security $security,
    ) {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): CompletedSession
    {
        if (!$data instanceof CompletedSession) {
            throw new \LogicException('This processor only supports CompletedSession entities.');
        }

        $user = $this->security->getUser();
        $trainingSession = $data->getTrainingSession();

        if ($trainingSession === null) {
            throw new AccessDeniedHttpException('Training session is required.');
        }

        if ($trainingSession->getAthlete()?->getCoach() !== $user) {
            throw new AccessDeniedHttpException('You cannot manage this completed session.');
        }

        if ($operation instanceof Delete) {
            $this->entityManager->remove($data);
            $this->entityManager->flush();

            return $data;
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