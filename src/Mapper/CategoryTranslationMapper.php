<?php


namespace App\Mapper;


use App\DTO\EditCategoryTranslationDTO;
use App\Entity\CategoryTranslation;

class CategoryTranslationMapper
{
    public function entityToEditTranslationDTO(?CategoryTranslation $categoryTranslation): EditCategoryTranslationDTO
    {
        if(!$categoryTranslation)
            return new EditCategoryTranslationDTO();

        return new EditCategoryTranslationDTO(
            $categoryTranslation->getName(),
            $categoryTranslation->getDescription(),
            $categoryTranslation->getShortDescription()
        );
    }

}