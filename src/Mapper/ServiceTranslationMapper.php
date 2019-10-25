<?php


namespace App\Mapper;


use App\DTO\EditServiceTranslationDTO;
use App\Entity\ServiceTranslation;

class ServiceTranslationMapper
{
    public function entityToEditServiceTranslationDTO(?ServiceTranslation $serviceTranslation): EditServiceTranslationDTO
    {
        if(!$serviceTranslation)
            return new EditServiceTranslationDTO();

        return new EditServiceTranslationDTO(
            $serviceTranslation->getName(),
            $serviceTranslation->getDescription()
        );
    }
}