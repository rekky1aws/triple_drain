<?php

namespace App\Repository;

use App\Entity\Pinball;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pinball>
 */
class PinballRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pinball::class);
    }

    public function findAll (): array 
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
         'SELECT p
         FROM App\Entity\Pinball p
         ORDER BY p.id ASC'
        );

        return $query->getResult();
    }

    //    /**
    //     * @return Pinball[] Returns an array of Pinball objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Pinball
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
