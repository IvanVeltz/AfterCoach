<?php

namespace App\State;

use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Athlete;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

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

        $user = $this->security->getUser();
        $now = new \DateTimeImmutable();

        if ($operation instanceof Delete) {
            if ($data->getCoach() !== $user) {
                throw new AccessDeniedHttpException('You cannot delete this athlete.');
            }

            $data->setIsActive(false);
            $data->setUpdatedAt($now);

            $this->entityManager->flush();

            return $data;
        }

        if ($data->getId() === null) {
            $data->setCoach($user);
            $data->setCreatedAt($now);
            $data->setIsActive(true);
        }

        $data->setUpdatedAt($now);

        $this->entityManager->persist($data);
        $this->entityManager->flush();

        return $data;
    }
}