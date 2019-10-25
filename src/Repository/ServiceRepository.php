<?php

namespace App\Repository;

use App\Entity\Service;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Service|null find($id, $lockMode = null, $lockVersion = null)
 * @method Service|null findOneBy(array $criteria, array $orderBy = null)
 * @method Service[]    findAll()
 * @method Service[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Service::class);
    }

    public function getServicesInRussian()
    {
        return $this->createQueryBuilder('service')
            ->leftJoin('service.serviceTranslations', 'service_translations')
            ->leftJoin('service_translations.locale', 'locale')
            ->where('locale.short_name =:name')
            ->select('service.id', 'service.price', 'service_translations.name')
            ->setParameter('name', 'ru')
            ->getQuery()->getResult();
    }

    public function getServicesNameInRussian()
    {
        return $this->createQueryBuilder('service')
            ->leftJoin('service.serviceTranslations', 'service_translations')
            ->leftJoin('service_translations.locale', 'locale')
            ->where('locale.short_name =:name')
            ->select('service.id', 'service_translations.name')
            ->setParameter('name', 'ru')
            ->getQuery()->getResult();
    }

    public function getServicesNameInRussianByCategoryId(int $id)
    {
        return $this->createQueryBuilder('service')
            ->leftJoin('service.serviceTranslations', 'service_translations')
            ->leftJoin('service_translations.locale', 'locale')
            ->where('locale.short_name =:name')
            ->andWhere('category.id =:id')
            ->leftJoin('service.category', 'category')
            ->select('service.id', 'service_translations.name')
            ->setParameter('name', 'ru')
            ->setParameter('id', $id)
            ->getQuery()->getResult();
    }
}
