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
        $project_limit = $request->query->getInt('project_limit');
        return new JsonResponse($this->categoryService->getCategories($limit, $project_limit), 200);
    }

    public function get_category(Request $request)
    {
        $id = $request->query->get('slug');
        $category = $this->categoryService->getCategory($id);
        dd($category);
        if(isset($category['status']) && $category['status'] === 404)
            return new JsonResponse(null, 404);


        return new JsonResponse($category, 200);
    }
}