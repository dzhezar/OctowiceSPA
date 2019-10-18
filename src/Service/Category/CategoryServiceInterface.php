<?php


namespace App\Service\Category;


use App\Mapper\CategoryMapper;
use App\Repository\CategoryRepository;

interface CategoryServiceInterface
{
    public function __construct(CategoryRepository $categoryRepository, CategoryMapper $categoryMapper);

    public function getCategories(int $limit);


}