<?php


namespace App\Mapper;


use App\DTO\CategoryNameDTO;
use App\DTO\CreateCategoryDTO;
use App\DTO\EditCategoryDTO;
use App\DTO\EditCategoryTranslationDTO;
use App\Entity\Category;
use App\Entity\CategoryTranslation;
use App\Entity\Locale;
use App\Repository\CategoryRepository;
use App\Repository\LocaleRepository;
use App\Repository\ServiceRepository;
use App\Service\UploadFile\UploadFileService;
use Cocur\Slugify\Slugify;

class CategoryMapper
{
    /**
     * @var LocaleRepository
     */
    private $localeRepository;

    private $locale_arr = [];
    /**
     * @var ServiceRepository
     */
    private $serviceRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var UploadFileService
     */
    private $uploadFileService;


    /**
     * CategoryMapper constructor.
     * @param LocaleRepository $localeRepository
     * @param ServiceRepository $serviceRepository
     * @param CategoryRepository $categoryRepository
     * @param UploadFileService $uploadFileService
     */
    public function __construct(LocaleRepository $localeRepository, ServiceRepository $serviceRepository, CategoryRepository $categoryRepository, UploadFileService $uploadFileService)
    {
        $this->localeRepository = $localeRepository;
        foreach ($localeRepository->getAllShortNames() as $item) {
            $this->locale_arr[] = $item['short_name'];
        }
        $this->serviceRepository = $serviceRepository;
        $this->categoryRepository = $categoryRepository;
        $this->uploadFileService = $uploadFileService;
    }

    public function EntityToEditCategoryDTO(Category $category): EditCategoryDTO
    {
        return new EditCategoryDTO(
            $category->getPrice(),
            $category->getSeoTitle(),
            $category->getSeoDescription()
        );
    }

    public function EditCategoryDTOtoEntity(EditCategoryDTO $categoryDTO): Category
    {
        $category = new Category();
        $category->setPrice($categoryDTO->getPrice())
            ->setSeoTitle($categoryDTO->getSeoTitle())
            ->setSeoDescription($categoryDTO->getSeoDescription())
            ->setPrice($categoryDTO->getPrice());
    }

    public function entityToArray(array $array, $limit = 0, $project_limit = 0): array
    {
        $result = [];
        if($limit){
            foreach ($array as $item) {
                if($limit > 0)
                $result[] = $this->convert($item, $project_limit);
                $limit--;
            }
        }
        else{
            foreach ($array as $item) {
                $result[] = $this->convert($item, $project_limit);
            }
        }



        return $result;
    }

    private function convert(Category $category, $project_limit = 0): array
    {
        $translations = [];
        foreach ($category->getCategoryTranslations() as $categoryTranslation) {
            $translations[$categoryTranslation->getLocale()->getShortName()] = ['name' => $categoryTranslation->getName(), 'description' => $categoryTranslation->getDescription()];
        }

        $projects = [];
        if(!$project_limit){
            foreach ($category->getProjects() as $key => $project) {
                $projects[$key] = ['id' => $project->getId(), 'slug' => $project->getSlug(), 'icon' => $project->getImage()];
                foreach ($project->getProjectTranslations() as $projectTranslation) {
                    $projects[$key]['translations'][$projectTranslation->getLocale()->getShortName()] = ['name' => $projectTranslation->getName(), 'description' => $projectTranslation->getDescription()];
                }

                foreach ($this->locale_arr as $item) {
                    if (!isset($projects[$key]['translations'][$item]) && isset($projects[$key]['translations']['ru']))
                        $projects[$key]['translations'][$item] = $projects[$key]['translations']['ru'];
                }
            }
        }
        else{
            foreach ($category->getProjects() as $key => $project) {
                if(!$project_limit)
                    break;
                else
                    $project_limit--;
                $projects[$key] = ['id' => $project->getId(), 'slug' => $project->getSlug(), 'icon' => $project->getImage()];
                foreach ($project->getProjectTranslations() as $projectTranslation) {
                    $projects[$key]['translations'][$projectTranslation->getLocale()->getShortName()] = ['name' => $projectTranslation->getName(), 'description' => $projectTranslation->getDescription()];
                }

                foreach ($this->locale_arr as $item) {
                    if (!isset($projects[$key]['translations'][$item]) && isset($projects[$key]['translations']['ru']))
                        $projects[$key]['translations'][$item] = $projects[$key]['translations']['ru'];
                }
            }
        }

        foreach ($this->locale_arr as $item) {
            if(!isset($translations[$item]) && isset($translations['ru']))
                $translations[$item] = $translations['ru'];
        }

        return [
            'id' => $category->getId(),
            'icon' => $category->getIcon(),
            'image' => $category->getImage(),
            'slug' => $category->getSlug(),
            'translations' => $translations,
            'projects' => $projects,
        ];
    }

    public function arrayToCategoryNameDTO($array): array
    {
        $result = [];
        foreach ($array as $item) {
            $result[] = $this->convertToCategoryNameDTO($item);
        }

        return $result;
    }

    public function convertToCategoryNameDTO($array): CategoryNameDTO
    {
        return new CategoryNameDTO(
            $array['id'],
            $array['name']
        );
    }

    public function EntityToApiArray(Category $category): array
    {
        $result = ['id' => $category->getId(), 'price' => $category->getPrice(), 'seo_title' => $category->getSeoTitle(), 'seo_description' => $category->getSeoDescription(), 'image' => $category->getIcon()];


        $result['translations'] = [];
        foreach ($category->getCategoryTranslations() as $categoryTranslation) {
            $result['translations'][$categoryTranslation->getLocale()->getShortName()] = ['name' => $categoryTranslation->getName(), 'description' => $categoryTranslation->getDescription(), 'epigraph' => $categoryTranslation->getEpigraph(), 'price_description' => $categoryTranslation->getPriceDescription(), 'short_description' => $categoryTranslation->getShortDescription(), 'long_description' => $categoryTranslation->getLongDescription()];
        }


        foreach ($this->locale_arr as $item) {
            if(!isset($result['translations'][$item]) && isset($result['translations']['ru']))
                $result['translations'][$item] = $result['translations']['ru'];
        }
        
        $result['services'] = [];
        foreach ($category->getServices() as $key => $service) {
            $result['services'][$key] = ['id' => $service->getId(), 'image' => $service->getImage()];
            foreach ($service->getServiceTranslations() as $serviceTranslation) {
                $result['services'][$key]['translations'][$serviceTranslation->getLocale()->getShortName()] = ['name' => $serviceTranslation->getName(), 'description' => $serviceTranslation->getDescription()];
            }

            foreach ($this->locale_arr as $item) {
                if(!isset($result['services'][$key]['translations'][$item]) && isset($result['services'][$key]['translations']['ru']))
                    $result['services'][$key]['translations'][$item] = $result['services'][$key]['translations']['ru'];
            }
        }


        return $result;
    }

    public function createCategoryDTOtoEntity(CreateCategoryDTO $categoryDTO): Category
    {
        $slugify = new Slugify();
        $category = new Category();

        $categoryDTO->setServices(json_decode($categoryDTO->getServices()));
        if($categoryDTO->getServices()) {
            foreach ($categoryDTO->getServices() as $item) {
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

        $category->setSeoTitle($categoryDTO->getSeoTitle())
            ->setSeoDescription($categoryDTO->getSeoDescription())
            ->setSlug($slugify->slugify($categoryDTO->getName()))
            ->setPrice($categoryDTO->getPrice())
            ->setQueue($queue);

        if($categoryDTO->getImage()){
            $file_name = $this->uploadFileService->upload($categoryDTO->getImage());
            $category->setImage($file_name);
        }
        if($categoryDTO->getIcon()){
            $file_name = $this->uploadFileService->upload($categoryDTO->getIcon());
            $category->setIcon($file_name);
        }

        return $category;
    }

    public function createCategoryDTOtoCategoryTranslationEntity(CreateCategoryDTO $categoryDTO, Category $category, Locale $locale): CategoryTranslation
    {
        $translation = new CategoryTranslation();
        $translation->setCategory($category)
            ->setLocale($locale)
            ->setName($categoryDTO->getName())
            ->setEpigraph($categoryDTO->getEpigraph())
            ->setPriceDescription($categoryDTO->getPriceDescription())
            ->setLongDescription($categoryDTO->getLongDescription())
            ->setShortDescription($categoryDTO->getShortDescription())
            ->setDescription($categoryDTO->getDescription());

        return $translation;
    }

    public function editCategoryDTOtoCategoryEntity(EditCategoryDTO $categoryDTO, Category $category): Category
    {
        /** @var EditCategoryDTO $data */
        $data = $categoryDTO;
        /** @var Category $id */
        $id = $category;
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

        return $id;
    }

    public function editCategoryTranslationDTOtoEntity(EditCategoryTranslationDTO $categoryTranslationDTO, ?CategoryTranslation $translation,  Category $category, Locale $locale): CategoryTranslation
    {
        if(!$translation){
            $translation = new CategoryTranslation();
            $translation->setName($categoryTranslationDTO->getName())
                ->setDescription($categoryTranslationDTO->getDescription())
                ->setShortDescription($categoryTranslationDTO->getShortDescription())
                ->setEpigraph($categoryTranslationDTO->getEpigraph())
                ->setLongDescription($categoryTranslationDTO->getLongDescription())
                ->setPriceDescription($categoryTranslationDTO->getPriceDescription())
                ->setCategory($category)
                ->setLocale($locale);
        }
        else{
            $translation->setName($categoryTranslationDTO->getName())
                ->setEpigraph($categoryTranslationDTO->getEpigraph())
                ->setPriceDescription($categoryTranslationDTO->getPriceDescription())
                ->setLongDescription($categoryTranslationDTO->getLongDescription())
                ->setShortDescription($categoryTranslationDTO->getShortDescription())
                ->setDescription($categoryTranslationDTO->getDescription());
        }

        if($locale->getShortName() === 'ru'){
            $slugify = new Slugify();
            $translation->getCategory()->setSlug($slugify->slugify($translation->getName()));
        }

        return $translation;
    }
}