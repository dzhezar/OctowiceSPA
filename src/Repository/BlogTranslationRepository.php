<?php

namespace App\Repository;

use App\Entity\BlogTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BlogTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogTranslation[]    findAll()
 * @method BlogTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogTranslation::class);
    }


    public function getBlogByIdAndLocale(int $blog, int $locale)
    {
        return $this->createQueryBuilder('blog_translation')
            ->leftJoin('blog_translation.blog', 'blog')
            ->leftJoin('blog_translation.locale', 'locale')
            ->select('blog_translation')
            ->where('blog.id =:blog_id')
            ->andWhere('locale.id =:locale_id')
            ->setParameter('blog_id', $blog)
            ->setParameter('locale_id', $locale)
            ->getQuery()->getResult();
    }
}
