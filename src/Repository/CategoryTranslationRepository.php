<?php

namespace App\Repository;

use App\Entity\CategoryTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategoryTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryTranslation[]    findAll()
 * @method CategoryTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryTranslation::class);
    }

    public function findByCategoryAndLocale(int $category, int $locale)
    {
        return $this->createQueryBuilder('cp')
            ->leftJoin('cp.category', 'cpc')
            ->leftJoin('cp.locale', 'cpl')
            ->where('cpc.id =:category_id')
            ->andWhere('cpl.id =:locale_id')
            ->setParameter('category_id', $category)
            ->setParameter('locale_id', $locale)
            ->getQuery()->getResult();
    }
}
