<?php


namespace App\Mapper;


use App\DTO\EditProjectDTO;
use App\DTO\EditProjectTranslationDTO;
use App\Entity\Project;
use App\Entity\ProjectTranslation;
use App\Repository\CategoryRepository;

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
     * ProjectMapper constructor.
     * @param CategoryRepository $categoryRepository
     * @param CategoryMapper $categoryMapper
     */
    public function __construct(CategoryRepository $categoryRepository, CategoryMapper $categoryMapper)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryMapper = $categoryMapper;
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

    public function entityToEditProjectTranslationDTO(ProjectTranslation $project): EditProjectTranslationDTO
    {
        return new EditProjectTranslationDTO(
            $project->getName(),
            $project->getDescription()
        );
    }
}