<?php


namespace App\Service\Category;


use App\DTO\CreateCategoryDTO;
use App\DTO\EditCategoryDTO;
use App\DTO\EditCategoryTranslationDTO;
use App\Entity\Category;
use App\Entity\CategoryTranslation;
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
use Cocur\Slugify\Slugify;
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

        $slugify = new Slugify();
        /** @var CreateCategoryDTO $data */
        $data = $createItem;
        $category = new Category();

        $data->setServices(json_decode($data->getServices()));
        if($data->getServices()) {
            foreach ($data->getServices() as $item) {
                $service_search = $this->serviceRepository->findOneBy(['id' => $item]);
                if ($service_search)
                    $category->addService($service_search);
            }
        }

        $queue = $this->categoryRepository->getLastQueue();
        if($queue)
            $queue = $queue[0]['queue']+1;
        elseif(!$queue)
            $queue = 1;

        $category->setSeoTitle($data->getSeoTitle())
            ->setSeoDescription($data->getSeoDescription())
            ->setSlug($slugify->slugify($data->getName()))
            ->setPrice($data->getPrice())
            ->setQueue($queue);

        if($data->getImage()){
            $file_name = $this->uploadFileService->upload($data->getImage());
            $category->setImage($file_name);
        }
        if($data->getIcon()){
            $file_name = $this->uploadFileService->upload($data->getIcon());
            $category->setIcon($file_name);
        }
        $this->entityManager->persist($category);
        $this->entityManager->flush();
        $translation = new CategoryTranslation();
        $translation->setCategory($category)
            ->setLocale($ru_locale)
            ->setName($data->getName())
            ->setEpigraph($data->getEpigraph())
            ->setPriceDescription($data->getPriceDescription())
            ->setLongDescription($data->getLongDescription())
            ->setShortDescription($data->getShortDescription())
            ->setDescription($data->getDescription());
        $this->entityManager->persist($translation);
        $this->entityManager->flush();
    }

    public function edit(EditItemInterface $editItem, $entity)
    {
        /** @var EditCategoryDTO $data */
        $data = $editItem;
        /** @var Category $id */
        $id = $entity;
        $data->setServices(json_decode($data->getServices()));
        foreach ($id->getServices() as $service) {
            $id->removeService($service);
        }
        if($data->getServices()) {
            foreach ($data->getServices() as $item) {
                $service_search = $this->serviceRepository->findOneBy(['id' => $item]);
                if ($service_search)
                    $id->addService($service_search);
            }
        }
        if($data->getImage()){
            if($id->getImage())
                $this->uploadFileService->remove($id->getImage());
            $newFileName = $this->uploadFileService->upload($data->getImage());
            $id->setImage($newFileName);
        }
        if($data->getIcon()){
            if($id->getIcon())
                $this->uploadFileService->remove($id->getIcon());
            $newFileName = $this->uploadFileService->upload($data->getIcon());
            $id->setIcon($newFileName);
        }
        $id->setPrice($data->getPrice())
            ->setSeoDescription($data->getSeoDescription())
            ->setSeoTitle($data->getSeoTitle());
        $this->entityManager->persist($id);
        $this->entityManager->flush();
    }

    public function edit_translation(EditItemTranslationInterface $editItemTranslation, $translation,  $entity, Locale $locale)
    {
        /** @var EditCategoryTranslationDTO $data */
        $data = $editItemTranslation;
        /** @var CategoryTranslation $translation */
        if(!$translation){
            $translation = new CategoryTranslation();
            $translation->setName($data->getName())
                ->setDescription($data->getDescription())
                ->setShortDescription($data->getShortDescription())
                ->setEpigraph($data->getEpigraph())
                ->setPriceDescription($data->getPriceDescription())
                ->setCategory($entity)
                ->setLocale($locale);
        }
        else{
            $translation->setName($data->getName())
                ->setEpigraph($data->getEpigraph())
                ->setPriceDescription($data->getPriceDescription())
                ->setLongDescription($data->getLongDescription())
                ->setShortDescription($data->getShortDescription())
                ->setDescription($data->getDescription());
        }

        if($locale->getShortName() === 'ru'){
            $slugify = new Slugify();
            $translation->getCategory()->setSlug($slugify->slugify($translation->getName()));
        }
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