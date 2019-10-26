<?php


namespace App\Mapper;


use App\DTO\EditBlogDTO;
use App\DTO\EditBlogTranslationDTO;
use App\Entity\Blog;
use App\Entity\BlogTranslation;

class BlogMapper
{
    public function EntityToEditBlogDTO(Blog $blog): EditBlogDTO
    {
        return new EditBlogDTO(
            $blog->getSeoTitle(),
            $blog->getSeoDescription()
        );
    }

    public function entityToEditBlogTranslationDTO(?BlogTranslation $blogTranslation):EditBlogTranslationDTO
    {
        if(!$blogTranslation)
            return new EditBlogTranslationDTO();

        return new EditBlogTranslationDTO(
            $blogTranslation->getName(),
            $blogTranslation->getDescription()
        );

    }

}