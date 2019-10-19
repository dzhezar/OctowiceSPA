<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Project|null find($id, $lockMode = null, $lockVersion = null)
 * @method Project|null findOneBy(array $criteria, array $orderBy = null)
 * @method Project[]    findAll()
 * @method Project[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    public function getProjectsInRussian()
    {
        return $this->createQueryBuilder('project')
            ->leftJoin('project.category', 'category')
            ->leftJoin('category.categoryTranslations', 'category_translations')
            ->leftJoin('category_translations.locale', 'category_locale')
            ->leftJoin('project.projectTranslations','project_translations')
            ->leftJoin('project_translations.locale', 'locale')
            ->where('locale.short_name =:name')
            ->andWhere('category_locale.short_name =:name')
            ->select('category_translations.name AS category_name', 'project_translations.name', 'project.id')
            ->setParameter('name', 'ru')
            ->getQuery()->getResult();
    }

    public function getProjectById(int $id)
    {
        return $this->createQueryBuilder('project')
            ->leftJoin('project.projectTranslations','project_translations')
            ->leftJoin('project_translations.locale', 'locale')
            ->leftJoin('project.projectImages', 'project_images')
            ->where('project.id =:id')
            ->setParameter('id', $id)
            ->select('project', 'project_translations', 'locale',  'project_images')
            ->getQuery()->getResult();
    }


}
