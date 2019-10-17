<?php


namespace App\Controller\Api;


use App\Service\Category\CategoryServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CategoryApiController extends AbstractController
{
    private $categoryService;

    /**
     * CategoryApiController constructor.
     * @param $categoryService
     */
    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }


    public function get_categories(Request $request)
    {
        $limit = $request->query->getInt('limit');
        dd($this->categoryService->getCategories($limit));
        return new JsonResponse($this->categoryService->getCategories($limit), 200);
    }
}