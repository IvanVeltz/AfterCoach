<?php

namespace App\State;

use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\CompletedSessionRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompletedSessionProvider implements ProviderInterface
{
    public function __construct(
        private readonly CompletedSessionRepository $completedSessionRepository,
        private readonly Security $security,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $user = $this->security->getUser();

        if (isset($uriVariables['id'])) {
            $id = $uriVariables['id'];

            $completedSession = $this->completedSessionRepository
                ->createQueryBuilder('cs')
                ->join('cs.trainingSession', 'ts')
                ->join('ts.athlete', 'a')
                ->andWhere('cs.id = :id')
                ->andWhere('a.coach = :coach')
                ->setParameter('id', $id)
                ->setParameter('coach', $user)
                ->getQuery()
                ->getOneOrNullResult();

            if ($completedSession === null) {
                throw new NotFoundHttpException('Completed session not found.');
            }

            return $completedSession;
        }

        if ($operation instanceof GetCollection) {
            return $this->completedSessionRepository
                ->createQueryBuilder('cs')
                ->join('cs.trainingSession', 'ts')
                ->join('ts.athlete', 'a')
                ->andWhere('a.coach = :coach')
                ->setParameter('coach', $user)
                ->getQuery()
                ->getResult();
        }

        return null;
    }
}