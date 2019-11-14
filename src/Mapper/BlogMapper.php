<?php


namespace App\Mapper;


use App\DTO\CreateBlogDto;
use App\DTO\EditBlogDTO;
use App\DTO\EditBlogTranslationDTO;
use App\Entity\Blog;
use App\Entity\BlogTranslation;
use App\Entity\Locale;
use App\Service\UploadFile\UploadFileService;
use Cocur\Slugify\Slugify;

class BlogMapper
{
    /**
     * @var UploadFileService
     */
    private $uploadFileService;


    /**
     * BlogMapper constructor.
     * @param UploadFileService $uploadFileService
     */
    public function __construct(UploadFileService $uploadFileService)
    {
        $this->uploadFileService = $uploadFileService;
    }

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

    public function createBlogDTOtoEntity(CreateBlogDto $createBlogDto): Blog
    {
        $blog = new Blog();

        if($createBlogDto->getImage()){
            $filename = $this->uploadFileService->upload($createBlogDto->getImage());
            $blog->setImage($filename);
        }

        $slugify = new Slugify();
        $blog->setSlug($slugify->slugify($createBlogDto->getName()))
            ->setSeoTitle($createBlogDto->getSeoTitle())
            ->setSeoDescription($createBlogDto->getSeoDescription());

        return $blog;
    }

    public function createBlogDTOtoTranslationEntity(CreateBlogDto $createBlogDto, Locale $locale, Blog $blog): BlogTranslation
    {
        $translation = new BlogTranslation();
        $translation->setName($createBlogDto->getName())
            ->setDescription($createBlogDto->getDescription())
            ->setLocale($locale)
            ->setBlog($blog);

        return $translation;
    }

    public function editBlogDTOtoEntity(EditBlogDTO $blogDTO, Blog $blog): Blog
    {
        if($blogDTO->getImage()){
            if($blog->getImage())
                $this->uploadFileService->remove($blog->getImage());
            $fileName = $this->uploadFileService->upload($blogDTO->getImage());
            $blog->setImage($fileName);
        }

        $blog->setSeoTitle($blogDTO->getSeoTitle())
            ->setSeoDescription($blogDTO->getSeoDescription());

        return $blog;
    }

    public function editBlogTranslationDTOtoEntity(EditBlogTranslationDTO $blogTranslationDTO, ?BlogTranslation $blogTranslation, Blog $blog, Locale $locale)
    {
        if(!$blogTranslation){
            $blogTranslation = new BlogTranslation();
            $blogTranslation->setBlog($blog);
            $blogTranslation->setLocale($locale);
        }

        $blogTranslation->setName($blogTranslationDTO->getName())
            ->setDescription($blogTranslationDTO->getDescription());

        return $blogTranslation;

    }

}