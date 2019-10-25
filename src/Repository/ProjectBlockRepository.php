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

    public function getBlocksByProjectId(int $id)
    {
        return $this->createQueryBuilder('project_block')
            ->leftJoin('project_block.project', 'project')
            ->leftJoin('project_block.projectBlockTranslations', 'project_block_translations')
            ->leftJoin('project_block_translations.locale', 'locale')
            ->select('project_block.id', 'project_block_translations.name')
            ->where('locale.short_name =:loc')
            ->andWhere('project.id =:id')
            ->orderBy('project_block.queue')
            ->setParameter('loc', 'ru')
            ->setParameter('id', $id)
            ->getQuery()->getResult();
    }

    public function getLastQueue()
    {
        return $this->createQueryBuilder('project_block')
            ->select('project_block.queue')
            ->orderBy('project_block.queue', 'DESC')
            ->setMaxResults(1)
            ->getQuery()->getResult();
    }
}
