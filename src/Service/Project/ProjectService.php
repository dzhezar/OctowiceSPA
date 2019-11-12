<?php


namespace App\Service\Project;


use App\DTO\CreateProjectDTO;
use App\DTO\EditProjectDTO;
use App\DTO\EditProjectTranslationDTO;
use App\Entity\Locale;
use App\Entity\Project;
use App\Entity\ProjectTranslation;
use App\Repository\CategoryRepository;
use App\Repository\LocaleRepository;
use App\Service\ItemEditor\CreateItemInterface;
use App\Service\ItemEditor\EditItemInterface;
use App\Service\ItemEditor\EditItemTranslationInterface;
use App\Service\ItemEditor\EntityEditorInterface;
use App\Service\UploadFile\UploadFileService;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

class ProjectService implements ProjectServiceInterface, EntityEditorInterface
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var UploadFileService
     */
    private $uploadFileService;
    /**
     * @var LocaleRepository
     */
    private $localeRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;


    /**
     * ProjectService constructor.
     * @param CategoryRepository $categoryRepository
     * @param UploadFileService $uploadFileService
     * @param LocaleRepository $localeRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(CategoryRepository $categoryRepository, UploadFileService $uploadFileService, LocaleRepository $localeRepository, EntityManagerInterface $entityManager)
    {
        $this->categoryRepository = $categoryRepository;
        $this->uploadFileService = $uploadFileService;
        $this->localeRepository = $localeRepository;
        $this->entityManager = $entityManager;
    }

    public function create(CreateItemInterface $createItem, $block = null)
    {
        /** @var CreateProjectDTO $data */
        $data = $createItem;
        $id = new Project();
        $category = $this->categoryRepository->findOneBy(['id' => $data->getCategory()->getId()]);
        if($category)
            $id->setCategory($category);
        if($data->getImage()){
            $newFileName = $this->uploadFileService->upload($data->getImage());
            $id->setImage($newFileName);
        }
        $id->setSeoDescription($data->getSeoDescription())
            ->setLink($data->getLink())
            ->setSeoTitle($data->getSeoTitle());
        $slugify = new Slugify();
        $id->setSlug($slugify->slugify($data->getName()));
        $this->entityManager->persist($id);
        $this->entityManager->flush();
        $locale = $this->localeRepository->findOneBy(['short_name' => 'ru']);
        if(!$locale)
            throw new Exception('Russian not found');
        $translation = new ProjectTranslation();
        $translation->setName($data->getName())
            ->setProject($id)
            ->setDescription($data->getDescription())
            ->setLocale($locale);
        $this->entityManager->persist($translation);
        $this->entityManager->flush();
    }

    public function edit(EditItemInterface $editItem, $entity)
    {
        /** @var Project $entity */
        /** @var EditProjectDTO $data */
        $data = $editItem;
        $category = $this->categoryRepository->findOneBy(['id' => $data->getCategory()->getId()]);
        if($category)
            $entity->setCategory($category);
        if($data->getImage()){
            if($entity->getImage())
                $this->uploadFileService->remove($entity->getImage());
            $newFileName = $this->uploadFileService->upload($data->getImage());
            $entity->setImage($newFileName);
        }
        $entity->setSeoDescription($data->getSeoDescription())
            ->setLink($data->getLink())
            ->setSeoTitle($data->getSeoTitle());
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function edit_translation(EditItemTranslationInterface $editItemTranslation, $translation, $entity, Locale $locale)
    {
        /** @var ProjectTranslation $translation */
        /** @var EditProjectTranslationDTO $data */
        $data = $editItemTranslation;
        if(!$translation){
            $translation = new ProjectTranslation();
            $translation->setName($data->getName())
                ->setDescription($data->getDescription())
                ->setProject($entity)
                ->setLocale($locale);
        }
        else{
            $translation->setName($data->getName())
                ->setDescription($data->getDescription());
        }
        if($locale->getShortName() === 'ru'){
            $slugify = new Slugify();
            $translation->getProject()->setSlug($slugify->slugify($translation->getName()));
        }
        $this->entityManager->persist($translation);
        $this->entityManager->flush();
    }

    public function remove($entity)
    {
        /** @var Project $entity */
        $this->uploadFileService->remove($entity->getImage());
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}