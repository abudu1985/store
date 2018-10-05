<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Device;

class DeviceRepository extends \Doctrine\ORM\EntityRepository
{
    public function findOneById(int $id): ?Device
    {
        return $this->createQueryBuilder('d')
            ->where('d.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findAllByAlies(string $alies): ?array
    {
        return $this->createQueryBuilder('d')
            ->where('d INSTANCE OF :discr')
            ->setParameter('discr', $alies)
            ->getQuery()
            ->getResult();
    }

}