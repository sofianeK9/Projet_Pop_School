<?php

namespace App\Repository;

use App\Entity\DonneesPedagogiques;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DonneesPedagogiques>
 *
 * @method DonneesPedagogiques|null find($id, $lockMode = null, $lockVersion = null)
 * @method DonneesPedagogiques|null findOneBy(array $criteria, array $orderBy = null)
 * @method DonneesPedagogiques[]    findAll()
 * @method DonneesPedagogiques[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonneesPedagogiquesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DonneesPedagogiques::class);
    }

//    /**
//     * @return DonneesPedagogiques[] Returns an array of DonneesPedagogiques objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DonneesPedagogiques
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
