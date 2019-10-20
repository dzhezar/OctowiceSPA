<?php

namespace App\Repository;

use App\Entity\ServiceTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ServiceTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiceTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiceTranslation[]    findAll()
 * @method ServiceTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServiceTranslation::class);
    }

}
