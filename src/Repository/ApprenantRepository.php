<?php

namespace App\Repository;

use App\Entity\Apprenant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Apprenant>
 *
 * @method Apprenant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Apprenant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Apprenant[]    findAll()
 * @method Apprenant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApprenantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Apprenant::class);
    }
/**
 * @return Apprenant[] Returns an array of Apprenant objects
 *  fonction qui effectue une jointure avec les entités DA et DP pour accéder à leurs données
 * condition : si le mot clé a été fourni et si le nom ou prénom correpond au mot clé, la méthode execute la requete et
 * enverra le résultat
 */
public function RechercheApprenant($keyword): array
{
    $query = $this->createQueryBuilder('a')
        ->leftJoin('a.donneesPedagogiques', 'dp')
        ->leftJoin('a.donneesAdministratives', 'da');

    if ($keyword) {
        $query->andWhere('a.nom LIKE :keyword OR a.prenom LIKE :keyword')
            ->setParameter('keyword', '%' . $keyword . '%');
    }

    return $query->getQuery()->getResult();
}

    

//    public function findOneBySomeField($value): ?Apprenant
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
