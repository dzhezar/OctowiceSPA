<?php


namespace App\Service\Category;


use App\Mapper\CategoryMapper;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\JsonResponse;


class CategoryService implements CategoryServiceInterface
{
    private $categoryRepository;
    private $categoryMapper;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     * @param CategoryMapper $categoryMapper
     */
    public function __construct(CategoryRepository $categoryRepository, CategoryMapper $categoryMapper)
    {
        $this->categoryRepository = $categoryRepository;

        $this->categoryMapper = $categoryMapper;
    }

    public function getCategories(int $limit, int $project_limit)
    {
        return $this->categoryMapper->entityToArray($this->categoryRepository->getCategories(), $limit, $project_limit);
    }

    public function getCategoriesInRussian(): array
    {
        return $this->categoryRepository->getCategoriesInRussian();

    }

    public function getCategory(string $slug)
    {
        $category = $this->categoryRepository->getCategory($slug);
        if(!$category)
            return ['status' => 404];

        return $this->categoryMapper->EntityToApiArray($category[0]);

    }
}