<?php

namespace App\Repository;

use App\Entity\Locale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Locale|null find($id, $lockMode = null, $lockVersion = null)
 * @method Locale|null findOneBy(array $criteria, array $orderBy = null)
 * @method Locale[]    findAll()
 * @method Locale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Locale::class);
    }

    public function getAllLanguages()
    {
        return $this->createQueryBuilder('l')
            ->select('l.name', 'l.short_name')
            ->getQuery()->getResult();
    }

    public function getAllShortNames()
    {
        return $this->createQueryBuilder('l')
            ->select('l.short_name')
            ->getQuery()->getResult();
    }
}
