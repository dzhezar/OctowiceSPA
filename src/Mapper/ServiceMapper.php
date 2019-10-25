<?php


namespace App\Mapper;


use App\DTO\EditServiceDTO;
use App\Entity\Service;

class ServiceMapper
{
    public function entityToEditServiceDTO(Service $service): EditServiceDTO
    {
        return new EditServiceDTO(
            $service->getPrice(),
            $service->getIsOnServicePage()
        );
    }

}