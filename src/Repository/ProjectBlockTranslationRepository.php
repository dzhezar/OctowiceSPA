<?php

namespace App\Repository;

use App\Entity\ProjectBlockTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ProjectBlockTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectBlockTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectBlockTranslation[]    findAll()
 * @method ProjectBlockTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectBlockTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjectBlockTranslation::class);
    }

    public function getTranslationByProjectAndLocaleID(int $block, int $locale)
    {
        return $this->createQueryBuilder('project_block_translation')
            ->leftJoin('project_block_translation.projectBlock', 'project_block')
            ->leftJoin('project_block_translation.locale', 'locale')
            ->where('project_block.id =:block_id')
            ->andWhere('locale.id =:locale')
            ->setParameter('block_id', $block)
            ->setParameter('locale', $locale)
            ->getQuery()->getResult();
    }

}
