<?php


namespace App\Service\Project;


use App\DTO\CreateProjectDTO;
use App\DTO\EditProjectDTO;
use App\DTO\EditProjectTranslationDTO;
use App\Entity\Locale;
use App\Entity\Project;
use App\Entity\ProjectTranslation;
use App\Mapper\ProjectMapper;
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
     * @var ProjectMapper
     */
    private $projectMapper;


    /**
     * ProjectService constructor.
     * @param CategoryRepository $categoryRepository
     * @param UploadFileService $uploadFileService
     * @param LocaleRepository $localeRepository
     * @param EntityManagerInterface $entityManager
     * @param ProjectMapper $projectMapper
     */
    public function __construct(CategoryRepository $categoryRepository, UploadFileService $uploadFileService, LocaleRepository $localeRepository, EntityManagerInterface $entityManager, ProjectMapper $projectMapper)
    {
        $this->categoryRepository = $categoryRepository;
        $this->uploadFileService = $uploadFileService;
        $this->localeRepository = $localeRepository;
        $this->entityManager = $entityManager;
        $this->projectMapper = $projectMapper;
    }

    public function create(CreateItemInterface $createItem, $block = null)
    {
        $locale = $this->localeRepository->findOneBy(['short_name' => 'ru']);
        if(!$locale)
            throw new Exception('Russian not found');

        $project = $this->projectMapper->createProjectDTOtoEntity($createItem);
        $this->entityManager->persist($project);
        $this->entityManager->flush();

        $translation = $this->projectMapper->createProjectTranslationDTOtoEntity($createItem, $project, $locale);
        $this->entityManager->persist($translation);
        $this->entityManager->flush();
    }

    public function edit(EditItemInterface $editItem, $entity)
    {
        $entity = $this->projectMapper->editProjectDTOtoEntity($editItem, $entity);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function edit_translation(EditItemTranslationInterface $editItemTranslation, $translation, $entity, Locale $locale)
    {
        $translation = $this->projectMapper->editProjectTranslationDTOtoEntity($editItemTranslation, $translation, $entity, $locale);
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