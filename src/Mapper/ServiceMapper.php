<?php


namespace App\Mapper;


use App\DTO\CreateServiceDTO;
use App\DTO\EditServiceDTO;
use App\DTO\EditServiceTranslationDTO;
use App\Entity\Locale;
use App\Entity\Service;
use App\Entity\ServiceTranslation;
use App\Service\UploadFile\UploadFileService;

class ServiceMapper
{
    /**
     * @var UploadFileService
     */
    private $uploadFileService;


    /**
     * ServiceMapper constructor.
     * @param UploadFileService $uploadFileService
     */
    public function __construct(UploadFileService $uploadFileService)
    {
        $this->uploadFileService = $uploadFileService;
    }

    public function entityToEditServiceDTO(Service $service): EditServiceDTO
    {
        return new EditServiceDTO(
            $service->getPrice(),
            $service->getIsOnServicePage()
        );
    }

    public function createServiceDTOtoEntity(CreateServiceDTO $data): Service
    {
        $service = new Service();
        $service->setPrice($data->getPrice())
            ->setIsOnServicePage($data->getIsOnServicePage());

        if($data->getImage()) {
            $fileName = $this->uploadFileService->upload($data->getImage());
            $service->setImage($fileName);
        }

        return $service;
    }

    public function createServiceDTOtoTranslationEntity(CreateServiceDTO $data, Service $service, Locale $locale): ServiceTranslation
    {
        $translation = new ServiceTranslation();
        $translation->setLocale($locale)
            ->setName($data->getName())
            ->setDescription($data->getDescription())
            ->setService($service);

        return $translation;
    }

    public function editServiceDTOtoEntity(EditServiceDTO $data, Service $entity): Service
    {
        $entity->setPrice($data->getPrice())
            ->setIsOnServicePage($data->getIsOnServicePage());
        if($data->getImage()){
            if($entity->getImage())
                $this->uploadFileService->remove($entity->getImage());
            $image = $this->uploadFileService->upload($data->getImage());
            $entity->setImage($image);
        }

        return $entity;
    }

    public function editServiceTranslationDTOtoEntity(EditServiceTranslationDTO $data, ?ServiceTranslation $translation, Service $service, Locale $locale): ServiceTranslation
    {
        if(!$translation){
            $translation = new ServiceTranslation();
            $translation
                ->setLocale($locale)
                ->setService($service);
        }
        $translation->setName($data->getName())
            ->setDescription($data->getDescription());

        return $translation;
    }

}