<?php


namespace App\Service\Category;


use App\Mapper\CategoryMapper;
use App\Repository\CategoryRepository;


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

    public function getCategories(int $limit)
    {
        return $this->categoryMapper->entityToArray($this->categoryRepository->getCategories(), $limit);
    }

    public function getCategoriesInRussian(): array
    {
        return $this->categoryRepository->getCategoriesInRussian();

    }
}