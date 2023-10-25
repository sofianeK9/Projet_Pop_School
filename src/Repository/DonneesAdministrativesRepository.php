<?php

namespace App\Repository;

use App\Entity\DonneesAdministratives;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DonneesAdministratives>
 *
 * @method DonneesAdministratives|null find($id, $lockMode = null, $lockVersion = null)
 * @method DonneesAdministratives|null findOneBy(array $criteria, array $orderBy = null)
 * @method DonneesAdministratives[]    findAll()
 * @method DonneesAdministratives[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonneesAdministrativesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DonneesAdministratives::class);
    }

//    /**
//     * @return DonneesAdministratives[] Returns an array of DonneesAdministratives objects
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

//    public function findOneBySomeField($value): ?DonneesAdministratives
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
