<?php

namespace App\State;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\State\ProviderInterface;
use App\Repository\TrainingSessionRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TrainingSessionProvider implements ProviderInterface
{
    public function __construct(
        private readonly TrainingSessionRepository $trainingSessionRepository,
        private readonly Security $security,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $user = $this->security->getUser();

        if ($operation instanceof GetCollection) {
            return $this->trainingSessionRepository
                ->createQueryBuilder('ts')
                ->join('ts.athlete', 'a')
                ->andWhere('a.coach = :coach')
                ->setParameter('coach', $user)
                ->getQuery()
                ->getResult();
        }

        if ($operation instanceof Get || $operation instanceof Patch || $operation instanceof Delete) {
            $id = $uriVariables['id'] ?? null;

            $trainingSession = $this->trainingSessionRepository
                ->createQueryBuilder('ts')
                ->join('ts.athlete', 'a')
                ->andWhere('ts.id = :id')
                ->andWhere('a.coach = :coach')
                ->setParameter('id', $id)
                ->setParameter('coach', $user)
                ->getQuery()
                ->getOneOrNullResult();

            if ($trainingSession === null) {
                throw new NotFoundHttpException('Training session not found.');
            }

            return $trainingSession;
        }

        return null;
    }
}