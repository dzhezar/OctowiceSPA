<?php


namespace App\Service\Service;


use App\DTO\CreateServiceDTO;
use App\DTO\EditServiceDTO;
use App\DTO\EditServiceTranslationDTO;
use App\Entity\Locale;
use App\Entity\Service;
use App\Entity\ServiceTranslation;
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
     * ServiceService constructor.
     * @param LocaleRepository $localeRepository
     * @param UploadFileService $uploadFileService
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(LocaleRepository $localeRepository, UploadFileService $uploadFileService, EntityManagerInterface $entityManager)
    {
        $this->localeRepository = $localeRepository;
        $this->uploadFileService = $uploadFileService;
        $this->entityManager = $entityManager;
    }

    public function create(CreateItemInterface $createItem, $block = null)
    {
        /** @var CreateServiceDTO $data */
        $data = $createItem;
        $locale_ru = $this->localeRepository->findOneBy(['short_name' => 'ru']);
        if(!$locale_ru)
            throw new Exception('No russian language');
        $service = new Service();
        $service->setPrice($data->getPrice())
            ->setIsOnServicePage($data->getIsOnServicePage());

        if($data->getImage()) {
            $fileName = $this->uploadFileService->upload($data->getImage());
            $service->setImage($fileName);
        }

        $this->entityManager->persist($service);
        $this->entityManager->flush();

        $translation = new ServiceTranslation();
        $translation->setLocale($locale_ru)
            ->setName($data->getName())
            ->setDescription($data->getDescription())
            ->setService($service);

        $this->entityManager->persist($translation);
        $this->entityManager->flush();
    }

    public function edit(EditItemInterface $editItem, $entity)
    {
        /** @var EditServiceDTO $data */
        $data = $editItem;
        /** @var Service $entity */
        $entity->setPrice($data->getPrice())
            ->setIsOnServicePage($data->getIsOnServicePage());
        if($data->getImage()){
            if($entity->getImage())
                $this->uploadFileService->remove($entity->getImage());
            $image = $this->uploadFileService->upload($data->getImage());
            $entity->setImage($image);
        }
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function edit_translation(EditItemTranslationInterface $editItemTranslation, $translation, $entity, Locale $locale)
    {
        /** @var EditServiceTranslationDTO $data */
        $data = $editItemTranslation;
        if(!$translation){
            $translation = new ServiceTranslation();
            $translation
                ->setLocale($locale)
                ->setService($entity);
        }
        $translation->setName($data->getName())
            ->setDescription($data->getDescription());

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