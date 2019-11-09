<?php


namespace App\Mapper;


use App\DTO\EditProjectBlockDTO;
use App\DTO\EditProjectTranslationDTO;
use App\Entity\ProjectBlock;
use App\Entity\ProjectBlockTranslation;

class ProjectBlockMapper
{
    public function entityToEditProjectBlockDTO(ProjectBlock $block): EditProjectBlockDTO
    {
        return new EditProjectBlockDTO(
            $block->getColor(),
            $block->getColorText()
        );
    }

    public function entityToEditProjectBlockTranslationDTO(ProjectBlockTranslation $block): EditProjectTranslationDTO
    {
        return new EditProjectTranslationDTO(
            $block->getName(),
            $block->getDescription()
        );
    }
}