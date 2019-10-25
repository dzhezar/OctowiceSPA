<?php

namespace App\Repository;

use App\Entity\ProjectTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProjectTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectTranslation[]    findAll()
 * @method ProjectTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectTranslation::class);
    }

    public function findByProjectAndLocale(int $project, int $locale)
    {
        return $this->createQueryBuilder('projectTranslation')
            ->leftJoin('projectTranslation.project', 'project')
            ->leftJoin('projectTranslation.locale', 'locale')
            ->setParameter('project', $project)
            ->setParameter('locale', $locale)
            ->where('project.id =:project')
            ->andWhere('locale.id =:locale')
            ->getQuery()->getResult();
    }
}
