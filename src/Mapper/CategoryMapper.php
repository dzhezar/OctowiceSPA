<?php


namespace App\Mapper;


use App\DTO\CategoryNameDTO;
use App\DTO\EditCategoryDTO;
use App\Entity\Category;
use App\Repository\LocaleRepository;

class CategoryMapper
{
    /**
     * @var LocaleRepository
     */
    private $localeRepository;

    private $locale_arr = [];


    /**
     * CategoryMapper constructor.
     * @param LocaleRepository $localeRepository
     */
    public function __construct(LocaleRepository $localeRepository)
    {
        $this->localeRepository = $localeRepository;
        foreach ($localeRepository->getAllShortNames() as $item) {
            $this->locale_arr[] = $item['short_name'];
        }
    }

    public function EntityToEditCategoryDTO(Category $category): EditCategoryDTO
    {
        return new EditCategoryDTO(
            $category->getPrice(),
            $category->getSeoTitle(),
            $category->getSeoDescription()
        );
    }

    public function EditCategoryDTOtoEntity(EditCategoryDTO $categoryDTO): Category
    {
        $category = new Category();
        $category->setPrice($categoryDTO->getPrice())
            ->setSeoTitle($categoryDTO->getSeoTitle())
            ->setSeoDescription($categoryDTO->getSeoDescription())
            ->setPrice($categoryDTO->getPrice());
    }

    public function entityToArray(array $array, $limit = 0): array
    {
        $result = [];
        if($limit){
            foreach ($array as $item) {
                if($limit > 0)
                $result[] = $this->convert($item);
                $limit--;
            }
        }
        else{
            foreach ($array as $item) {
                $result[] = $this->convert($item);
            }
        }



        return $result;
    }

    private function convert(Category $category): array
    {
        $translations = [];
        foreach ($category->getCategoryTranslations() as $categoryTranslation) {
            $translations[$categoryTranslation->getLocale()->getShortName()] = ['name' => $categoryTranslation->getName(), 'description' => $categoryTranslation->getDescription()];
        }

        $projects = [];
        foreach ($category->getProjects() as $key => $project) {
            $projects[$key] = [];
            foreach ($project->getProjectTranslations() as $projectTranslation) {
                $projects[$key][$projectTranslation->getLocale()->getShortName()] = ['name' => $projectTranslation->getName(), 'description' => $projectTranslation->getDescription()];
            }

            foreach ($this->locale_arr as $item) {
                if (!isset($projects[$key][$item]) && isset($projects[$key]['ru']))
                    $projects[$key][$item] = $projects[$key]['ru'];
            }
        }

        foreach ($this->locale_arr as $item) {
            if(!isset($translations[$item]) && isset($translations['ru']))
                $translations[$item] = $translations['ru'];
        }

        return [
            'id' => $category->getId(),
            'icon' => $category->getIcon(),
            'translations' => $translations,
            'projects' => $projects,
        ];
    }

    public function arrayToCategoryNameDTO($array): array
    {
        $result = [];
        foreach ($array as $item) {
            $result[] = $this->convertToCategoryNameDTO($item);
        }

        return $result;
    }

    public function convertToCategoryNameDTO($array): CategoryNameDTO
    {
        return new CategoryNameDTO(
            $array['id'],
            $array['name']
        );
    }



}