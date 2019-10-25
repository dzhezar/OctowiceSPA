<?php

namespace App\Repository;

use App\Entity\Blog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Blog|null find($id, $lockMode = null, $lockVersion = null)
 * @method Blog|null findOneBy(array $criteria, array $orderBy = null)
 * @method Blog[]    findAll()
 * @method Blog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blog::class);
    }

    public function getBlogs()
    {
        return $this->createQueryBuilder('blog')
            ->leftJoin('blog.blogTranslations', 'blog_translations')
            ->leftJoin('blog_translations.locale', 'locale')
            ->where('locale.short_name =:loc')
            ->select('blog.id', 'blog_translations.name')
            ->select('blog.id', 'blog_translations.name')
            ->setParameter('loc', 'ru')
            ->getQuery()->getResult();
    }
}
