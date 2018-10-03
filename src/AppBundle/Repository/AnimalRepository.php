<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Animal;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class AnimalRepository
{
    private $entityRepository;
    private $entityManager;

    public function __construct(
        EntityRepository $entityRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->entityRepository = $entityRepository;
        $this->entityManager = $entityManager;
    }

    public function findOneById(int $id): ?Animal
    {
        return $this->entityRepository->createQueryBuilder('e')
            ->where('e.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function insert(Animal $animal): void
    {
        $this->entityManager->persist($animal);
        $this->entityManager->flush();
    }
}