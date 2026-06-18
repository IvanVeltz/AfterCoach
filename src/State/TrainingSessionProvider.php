<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\TrainingSessionRepository;
use Symfony\Bundle\SecurityBundle\Security;

class TrainingSessionProvider implements ProviderInterface
{
    public function __construct(
        private TrainingSessionRepository $trainingSessionRepository,
        private Security $security,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $user = $this->security->getUser();

        return $this->trainingSessionRepository
            ->createQueryBuilder('ts')
            ->join('ts.athlete', 'a')
            ->andWhere('a.coach = :coach')
            ->setParameter('coach', $user)
            ->getQuery()
            ->getResult();
    }
}