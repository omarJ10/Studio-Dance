<?php

namespace App\Repository;

use App\Entity\HistoriquePersonnel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HistoriquePersonnel>
 *
 * @method HistoriquePersonnel|null find($id, $lockMode = null, $lockVersion = null)
 * @method HistoriquePersonnel|null findOneBy(array $criteria, array $orderBy = null)
 * @method HistoriquePersonnel[]    findAll()
 * @method HistoriquePersonnel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoriquePersonnelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistoriquePersonnel::class);
    }

    public function add(HistoriquePersonnel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(HistoriquePersonnel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return HistoriquePersonnel[] Returns an array of HistoriquePersonnel objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HistoriquePersonnel
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
