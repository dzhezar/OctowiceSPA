<?php


namespace App\Service\Category;


use App\Mapper\CategoryMapper;
use App\Repository\CategoryRepository;
use App\Repository\LocaleRepository;
use Doctrine\ORM\EntityManagerInterface;

interface CategoryServiceInterface
{

    public function getCategories(int $limit, int $project_limit);

    public function getCategoriesInRussian();

    public function getCategory(string $slug);

}