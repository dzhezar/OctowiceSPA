<?php


namespace App\Mapper;


use App\DTO\CreateProjectBlockDTO;
use App\DTO\CreateProjectDTO;
use App\DTO\EditProjectDTO;
use App\DTO\EditProjectTranslationDTO;
use App\Entity\Locale;
use App\Entity\Project;
use App\Entity\ProjectTranslation;
use App\Repository\CategoryRepository;
use App\Service\UploadFile\UploadFileService;
use Cocur\Slugify\Slugify;

class ProjectMapper
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var CategoryMapper
     */
    private $categoryMapper;
    /**
     * @var UploadFileService
     */
    private $uploadFileService;


    /**
     * ProjectMapper constructor.
     * @param CategoryRepository $categoryRepository
     * @param CategoryMapper $categoryMapper
     * @param UploadFileService $uploadFileService
     */
    public function __construct(CategoryRepository $categoryRepository, CategoryMapper $categoryMapper, UploadFileService $uploadFileService)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryMapper = $categoryMapper;
        $this->uploadFileService = $uploadFileService;
    }

    public function entityToEditProjectDTO(Project $project): EditProjectDTO
    {
        $category = $this->categoryMapper->convertToCategoryNameDTO($this->categoryRepository->getCategoryInRussian($project->getCategory()->getId())[0]);

        return new EditProjectDTO(
            $project->getSeoTitle(),
            $project->getSeoDescription(),
            $project->getLink(),
            $category
        );
    }

    public function entityToEditProjectTranslationDTO(?ProjectTranslation $project): EditProjectTranslationDTO
    {
        if(!$project)
            return new EditProjectTranslationDTO();
        return new EditProjectTranslationDTO(
            $project->getName(),
            $project->getDescription()
        );
    }

    public function createProjectDTOtoEntity(CreateProjectDTO $data): Project
    {
        $id = new Project();
        $category = $this->categoryRepository->findOneBy(['id' => $data->getCategory()->getId()]);
        if($category)
            $id->setCategory($category);
        if($data->getImage()){
            $newFileName = $this->uploadFileService->upload($data->getImage());
            $id->setImage($newFileName);
        }
        $id->setSeoDescription($data->getSeoDescription())
            ->setLink($data->getLink())
            ->setSeoTitle($data->getSeoTitle());
        $slugify = new Slugify();
        $id->setSlug($slugify->slugify($data->getName()));

        return $id;
    }

    public function createProjectTranslationDTOtoEntity(CreateProjectDTO $data, Project $project, Locale $locale): ProjectTranslation
    {
        $translation = new ProjectTranslation();
        $translation->setName($data->getName())
            ->setProject($project)
            ->setDescription($data->getDescription())
            ->setLocale($locale);

        return $translation;
    }

    public function editProjectDTOtoEntity(EditProjectDTO $data, Project $entity): Project
    {
        $category = $this->categoryRepository->findOneBy(['id' => $data->getCategory()->getId()]);
        if($category)
            $entity->setCategory($category);
        if($data->getImage()){
            if($entity->getImage())
                $this->uploadFileService->remove($entity->getImage());
            $newFileName = $this->uploadFileService->upload($data->getImage());
            $entity->setImage($newFileName);
        }
        $entity->setSeoDescription($data->getSeoDescription())
            ->setLink($data->getLink())
            ->setSeoTitle($data->getSeoTitle());

        return $entity;
    }

    public function editProjectTranslationDTOtoEntity(EditProjectTranslationDTO $data, ?ProjectTranslation $translation, Project $project, Locale $locale): ProjectTranslation
    {
        if(!$translation){
            $translation = new ProjectTranslation();
            $translation->setName($data->getName())
                ->setDescription($data->getDescription())
                ->setProject($project)
                ->setLocale($locale);
        }
        else{
            $translation->setName($data->getName())
                ->setDescription($data->getDescription());
        }
        if($locale->getShortName() === 'ru'){
            $slugify = new Slugify();
            $translation->getProject()->setSlug($slugify->slugify($translation->getName()));
        }

        return $translation;
    }
}