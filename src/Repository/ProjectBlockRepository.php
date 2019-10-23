<?php

namespace App\Repository;

use App\Entity\ProjectBlock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProjectBlock|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectBlock|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectBlock[]    findAll()
 * @method ProjectBlock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectBlockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectBlock::class);
    }

    // /**
    //  * @return ProjectBlock[] Returns an array of ProjectBlock objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProjectBlock
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
