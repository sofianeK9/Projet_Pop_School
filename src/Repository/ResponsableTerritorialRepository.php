<?php

namespace App\Repository;

use App\Entity\ResponsableTerritorial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ResponsableTerritorial>
 *
 * @method ResponsableTerritorial|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResponsableTerritorial|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResponsableTerritorial[]    findAll()
 * @method ResponsableTerritorial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResponsableTerritorialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResponsableTerritorial::class);
    }

//    /**
//     * @return ResponsableTerritorial[] Returns an array of ResponsableTerritorial objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ResponsableTerritorial
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
