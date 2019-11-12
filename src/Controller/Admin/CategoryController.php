<?php


namespace App\Controller\Admin;


use App\Entity\Category;
use App\Entity\Locale;
use App\Form\CreateCategoryForm;
use App\Form\EditCategoryForm;
use App\Form\EditCategoryTranslationForm;
use App\Mapper\CategoryMapper;
use App\Mapper\CategoryTranslationMapper;
use App\Repository\CategoryRepository;
use App\Repository\CategoryTranslationRepository;
use App\Repository\LocaleRepository;
use App\Repository\ServiceRepository;
use App\Service\Category\CategoryService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends AbstractController
{
    private $categoryMapper;
    private $em;
    private $categoryRepository;
    private $categoryService;

    /**
     * CategoryController constructor.
     * @param CategoryMapper $categoryMapper
     * @param EntityManagerInterface $em
     * @param CategoryTranslationRepository $categoryRepository
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryMapper $categoryMapper, EntityManagerInterface $em, CategoryTranslationRepository $categoryRepository, CategoryService $categoryService)
    {
        $this->categoryMapper = $categoryMapper;
        $this->em = $em;
        $this->categoryRepository = $categoryRepository;
        $this->categoryService = $categoryService;
    }

    public function index(CategoryRepository $categoryRepository, LocaleRepository $localeRepository)
    {
        return $this->render('admin/category/index.html.twig', ['categories' => $categoryRepository->getCategoriesInRussian(), 'locales' => $localeRepository->getAllLanguages()]);
    }

    public function create_category(Request $request, ServiceRepository $serviceRepository)
    {
        $form = $this->createForm(CreateCategoryForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->categoryService->create($form->getData());
            return $this->redirectToRoute('category_main');
        }

        return $this->render('admin/category/create.category.html.twig', ['form' => $form->createView(), 'services' => json_encode($serviceRepository->getServicesNameInRussian())]);
    }

    public function edit_category(Category $id, Request $request, ServiceRepository $serviceRepository)
    {
        $form = $this->createForm(EditCategoryForm::class, $this->categoryMapper->EntityToEditCategoryDTO($id));
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->categoryService->edit($form->getData(), $id);
            return $this->redirectToRoute('category_main');
        }


        return $this->render('admin/category/edit_category.html.twig', [
            'form' => $form->createView(),
            'image' => $id->getImage(),
            'icon' => $id->getIcon(),
            'services' => json_encode($serviceRepository->getServicesNameInRussian()),
            'current_services' => json_encode($serviceRepository->getServicesNameInRussianByCategoryId($id->getId()))]);
    }

    public function edit_category_translation(Category $category, Locale $locale, Request $request, CategoryTranslationMapper $categoryTranslationMapper)
    {
        $translation = $this->categoryRepository->findByCategoryAndLocale($category->getId(), $locale->getId());

        if(!isset($translation[0]))
            $translation = null;
        elseif($translation)
            $translation = $translation[0];

        $form = $this->createForm(EditCategoryTranslationForm::class, $categoryTranslationMapper->entityToEditTranslationDTO($translation));
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->categoryService->edit_translation($form->getData(), $translation, $category, $locale);
            return $this->redirectToRoute('category_main');
        }

        return $this->render('admin/category/edit_category_translation.html.twig', ['form' => $form->createView(), 'text' => $locale->getName().' Перевод']);
    }

    public function remove_category(Category $category)
    {
        $this->categoryService->remove($category);
        return $this->redirectToRoute('category_main');
    }

}