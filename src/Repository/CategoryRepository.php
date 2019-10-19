<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function getCategories()
    {
        $query = $this->createQueryBuilder('c');

            $query
                ->leftJoin('c.projects', 'cp')
                ->leftJoin('cp.projectTranslations', 'cpp')
                ->leftJoin('c.categoryTranslations', 'ct')
                ->leftJoin('ct.locale', 'cl')
                ->select('c', 'ct', 'cl', 'cp', 'cpp');

        return $query->getQuery()->getResult();
    }

    public function getCategoriesInRussian()
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.categoryTranslations','cc')
            ->leftJoin('cc.locale', 'cl')
            ->where('cl.short_name =:name')
            ->select('c.price', 'c.id', 'cc.name')
            ->setParameter('name', 'ru')
            ->getQuery()->getResult();
    }

    public function getCategoriesNameInRussian()
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.categoryTranslations','cc')
            ->leftJoin('cc.locale', 'cl')
            ->where('cl.short_name =:name')
            ->select('c.id', 'cc.name')
            ->setParameter('name', 'ru')
            ->getQuery()->getResult();
    }

    public function getCategoryInRussian($id)
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.categoryTranslations','cc')
            ->leftJoin('cc.locale', 'cl')
            ->where('cl.short_name =:name')
            ->andWhere('c.id =:id')
            ->select('c.price', 'c.id', 'cc.name')
            ->setParameter('name', 'ru')
            ->setParameter('id', $id)
            ->getQuery()->getResult();
    }
}
