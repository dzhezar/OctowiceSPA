<?php


namespace App\Service\Service;


use App\DTO\CreateServiceDTO;
use App\DTO\EditServiceDTO;
use App\DTO\EditServiceTranslationDTO;
use App\Entity\Locale;
use App\Entity\Service;
use App\Entity\ServiceTranslation;
use App\Mapper\ServiceMapper;
use App\Repository\LocaleRepository;
use App\Service\ItemEditor\CreateItemInterface;
use App\Service\ItemEditor\EditItemInterface;
use App\Service\ItemEditor\EditItemTranslationInterface;
use App\Service\ItemEditor\EntityEditorInterface;
use App\Service\UploadFile\UploadFileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

class ServiceService implements ServiceInterface, EntityEditorInterface
{
    /**
     * @var LocaleRepository
     */
    private $localeRepository;
    /**
     * @var UploadFileService
     */
    private $uploadFileService;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ServiceMapper
     */
    private $serviceMapper;


    /**
     * ServiceService constructor.
     * @param LocaleRepository $localeRepository
     * @param UploadFileService $uploadFileService
     * @param EntityManagerInterface $entityManager
     * @param ServiceMapper $serviceMapper
     */
    public function __construct(LocaleRepository $localeRepository, UploadFileService $uploadFileService, EntityManagerInterface $entityManager, ServiceMapper $serviceMapper)
    {
        $this->localeRepository = $localeRepository;
        $this->uploadFileService = $uploadFileService;
        $this->entityManager = $entityManager;
        $this->serviceMapper = $serviceMapper;
    }

    public function create(CreateItemInterface $createItem, $block = null)
    {
        $locale_ru = $this->localeRepository->findOneBy(['short_name' => 'ru']);
        if(!$locale_ru)
            throw new Exception('No russian language');
        $service = $this->serviceMapper->createServiceDTOtoEntity($createItem);

        $this->entityManager->persist($service);
        $this->entityManager->flush();

        $translation = $this->serviceMapper->createServiceDTOtoTranslationEntity($createItem, $service, $locale_ru);
        $this->entityManager->persist($translation);
        $this->entityManager->flush();
    }

    public function edit(EditItemInterface $editItem, $entity)
    {
        $entity = $this->serviceMapper->editServiceDTOtoEntity($editItem, $entity);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function edit_translation(EditItemTranslationInterface $editItemTranslation, $translation, $entity, Locale $locale)
    {
        $translation = $this->serviceMapper->editServiceTranslationDTOtoEntity($editItemTranslation, $translation, $entity, $locale);
        $this->entityManager->persist($translation);
        $this->entityManager->flush();
    }

    public function remove($entity)
    {
        /** @var Service $entity */
        if($entity->getImage())
            $this->uploadFileService->remove($entity->getImage());

        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}