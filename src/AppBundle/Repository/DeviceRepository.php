<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Device;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class DeviceRepository
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

    public function findOneById(int $id): ?Device
    {
        return $this->entityRepository->createQueryBuilder('d')
            ->where('d.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findAll(int $id): ?Device
    {
        return $this->entityRepository->createQueryBuilder('d')
            ->where('d.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }


    public function insert(Device $device): void
    {
        $this->entityManager->persist($device);
        $this->entityManager->flush();
    }
}