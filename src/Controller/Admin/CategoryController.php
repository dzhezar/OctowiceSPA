<?php


namespace App\Controller\Admin;


use App\DTO\CreateCategoryDTO;
use App\DTO\EditCategoryDTO;
use App\DTO\EditCategoryTranslationDTO;
use App\Entity\Category;
use App\Entity\CategoryTranslation;
use App\Entity\Locale;
use App\Form\CreateCategoryForm;
use App\Form\EditCategoryForm;
use App\Form\EditCategoryTranslationForm;
use App\Mapper\CategoryMapper;
use App\Mapper\CategoryTranslationMapper;
use App\Repository\CategoryRepository;
use App\Repository\CategoryTranslationRepository;
use App\Repository\LocaleRepository;
use App\Service\UploadFile\UploadFileService;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends AbstractController
{
    private $categoryMapper;
    private $em;
    private $categoryRepository;

    /**
     * CategoryController constructor.
     * @param CategoryMapper $categoryMapper
     * @param EntityManagerInterface $em
     * @param CategoryTranslationRepository $categoryRepository
     */
    public function __construct(CategoryMapper $categoryMapper, EntityManagerInterface $em, CategoryTranslationRepository $categoryRepository)
    {
        $this->categoryMapper = $categoryMapper;
        $this->em = $em;
        $this->categoryRepository = $categoryRepository;
    }

    public function create_category(Request $request, UploadFileService $uploadFileService, LocaleRepository $localeRepository)
    {
        $form = $this->createForm(CreateCategoryForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $ru_locale = $localeRepository->findOneBy(['short_name' => 'ru']);
            if(!$ru_locale)
                throw new Exception('Гг, русский язык удалён');

            $slugify = new Slugify();
            /** @var CreateCategoryDTO $data */
            $data = $form->getData();
            $category = new Category();
            $category->setSeoTitle($data->getSeoTitle())
                ->setSeoDescription($data->getSeoDescription())
                ->setSlug($slugify->slugify($data->getName()))
                ->setPrice($data->getPrice());
            if($data->getImage()){
                $file_name = $uploadFileService->upload($data->getImage());
                $category->setIcon($file_name);
            }
            $this->em->persist($category);
            $this->em->flush();
            $translation = new CategoryTranslation();
            $translation->setCategory($category)
                ->setLocale($ru_locale)
                ->setName($data->getName())
                ->setDescription($data->getDescription());
            $this->em->persist($translation);
            $this->em->flush();

            return $this->redirectToRoute('category_main');

        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView()]);
    }

    public function index(CategoryRepository $categoryRepository, LocaleRepository $localeRepository)
    {
        return $this->render('admin/category/index.html.twig', ['categories' => $categoryRepository->getCategoriesInRussian(), 'locales' => $localeRepository->getAllLanguages()]);
    }



    public function remove_category(Category $category, UploadFileService $uploadFileService)
    {
        $uploadFileService->remove($category->getIcon());
        $this->em->remove($category);
        $this->em->flush();
        return $this->redirectToRoute('category_main');
    }

    public function edit_category(Category $id, Request $request, UploadFileService $uploadedFile)
    {
        $form = $this->createForm(EditCategoryForm::class, $this->categoryMapper->EntityToEditCategoryDTO($id));
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var EditCategoryDTO $data */
            $data = $form->getData();
            if($data->getImage()){
                $newFileName = $uploadedFile->upload($data->getImage());
                $id->setIcon($newFileName);
            }
            $id->setPrice($data->getPrice())
                ->setSeoDescription($data->getSeoDescription())
                ->setSeoTitle($data->getSeoTitle());
            $this->em->persist($id);
            $this->em->flush();
            return $this->redirectToRoute('category_main');
        }


        return $this->render('admin/category/edit_category.html.twig', ['form' => $form->createView(), 'image' => $id->getIcon()]);
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
            /** @var EditCategoryTranslationDTO $data */
            $data = $form->getData();
            if(!$translation){
                $translation = new CategoryTranslation();
                $translation->setName($data->getName())
                    ->setDescription($data->getDescription())
                    ->setCategory($category)
                    ->setLocale($locale);
            }
            else{
                $translation->setName($data->getName())
                    ->setDescription($data->getDescription());
            }
            if($locale->getShortName() === 'ru'){
                $slugify = new Slugify();
                $translation->getCategory()->setSlug($slugify->slugify($translation->getName()));
            }
            $this->em->persist($translation);
            $this->em->flush();
            return $this->redirectToRoute('category_main');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView(), 'text' => $locale->getName().' Перевод']);
    }


}