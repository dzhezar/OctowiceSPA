<?php


namespace App\Service\Category;


use App\Entity\Locale;
use App\Mapper\CategoryMapper;
use App\Repository\CategoryRepository;
use App\Repository\LocaleRepository;
use App\Repository\ServiceRepository;
use App\Service\ItemEditor\CreateItemInterface;
use App\Service\ItemEditor\EditItemInterface;
use App\Service\ItemEditor\EditItemTranslationInterface;
use App\Service\ItemEditor\EntityEditorInterface;
use App\Service\UploadFile\UploadFileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;


class CategoryService implements CategoryServiceInterface, EntityEditorInterface
{
    private $categoryRepository;
    private $categoryMapper;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var LocaleRepository
     */
    private $localeRepository;
    /**
     * @var UploadFileService
     */
    private $uploadFileService;
    /**
     * @var ServiceRepository
     */
    private $serviceRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     * @param CategoryMapper $categoryMapper
     * @param EntityManagerInterface $entityManager
     * @param LocaleRepository $localeRepository
     * @param UploadFileService $uploadFileService
     * @param ServiceRepository $serviceRepository
     */
    public function __construct(CategoryRepository $categoryRepository, CategoryMapper $categoryMapper, EntityManagerInterface $entityManager, LocaleRepository $localeRepository, UploadFileService $uploadFileService, ServiceRepository $serviceRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryMapper = $categoryMapper;
        $this->entityManager = $entityManager;
        $this->localeRepository = $localeRepository;
        $this->uploadFileService = $uploadFileService;
        $this->serviceRepository = $serviceRepository;
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

    public function create(CreateItemInterface $createItem, $block = null)
    {
        $ru_locale = $this->localeRepository->findOneBy(['short_name' => 'ru']);
        if(!$ru_locale)
            throw new Exception('Russian not found');

        $category = $this->categoryMapper->createCategoryDTOtoEntity($createItem);
        $this->entityManager->persist($category);
        $this->entityManager->flush();

        $translation = $this->categoryMapper->createCategoryDTOtoCategoryTranslationEntity($createItem, $category, $ru_locale);
        $this->entityManager->persist($translation);
        $this->entityManager->flush();
    }

    public function edit(EditItemInterface $editItem, $entity)
    {
        $category = $this->categoryMapper->editCategoryDTOtoCategoryEntity($editItem, $entity);
        $this->entityManager->persist($category);
        $this->entityManager->flush();
    }

    public function edit_translation(EditItemTranslationInterface $editItemTranslation, $translation,  $entity, Locale $locale)
    {
        $translation = $this->categoryMapper->editCategoryTranslationDTOtoEntity($editItemTranslation, $translation, $entity, $locale);
        $this->entityManager->persist($translation);
        $this->entityManager->flush();
    }

    public function remove($removeItem)
    {
        $this->uploadFileService->remove($removeItem->getIcon());
        $this->entityManager->remove($removeItem);
        $this->entityManager->flush();

    }
}