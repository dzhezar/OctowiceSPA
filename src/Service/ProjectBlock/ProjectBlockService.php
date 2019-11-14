<?php


namespace App\Service\ProjectBlock;


use App\DTO\EditProjectBlockDTO;
use App\DTO\EditProjectBlockTranslationDTO;
use App\Entity\Locale;
use App\Entity\ProjectBlock;
use App\Entity\ProjectBlockTranslation;
use App\Mapper\ProjectBlockMapper;
use App\Repository\LocaleRepository;
use App\Repository\ProjectBlockRepository;
use App\Service\ItemEditor\CreateItemInterface;
use App\Service\ItemEditor\EditItemInterface;
use App\Service\ItemEditor\EditItemTranslationInterface;
use App\Service\ItemEditor\EntityEditorInterface;
use App\Service\UploadFile\UploadFileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

class ProjectBlockService implements ProjectBlockServiceInterface, EntityEditorInterface
{
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
     * @var ProjectBlockRepository
     */
    private $projectBlockRepository;
    /**
     * @var ProjectBlockMapper
     */
    private $projectBlockMapper;


    /**
     * ProjectBlockService constructor.
     * @param ProjectBlockRepository $projectBlockRepository
     * @param EntityManagerInterface $entityManager
     * @param LocaleRepository $localeRepository
     * @param UploadFileService $uploadFileService
     * @param ProjectBlockMapper $projectBlockMapper
     */
    public function __construct(ProjectBlockRepository $projectBlockRepository, EntityManagerInterface $entityManager, LocaleRepository $localeRepository, UploadFileService $uploadFileService, ProjectBlockMapper $projectBlockMapper)
    {
        $this->entityManager = $entityManager;
        $this->localeRepository = $localeRepository;
        $this->uploadFileService = $uploadFileService;
        $this->projectBlockRepository = $projectBlockRepository;
        $this->projectBlockMapper = $projectBlockMapper;
    }

    public function create(CreateItemInterface $createItem, $project = null)
    {
        $locale_ru = $this->localeRepository->findOneBy(['short_name' => 'ru']);
        if(!$locale_ru)
            throw new Exception('Russian not found');

        $block = $this->projectBlockMapper->createProjectBlockDTOtoEntity($createItem, $project);
        $this->entityManager->persist($block);
        $this->entityManager->flush();

        $blockTranslation = $this->projectBlockMapper->createProjectBlockTranslationDTOtoEntity($createItem, $block, $locale_ru);
        $this->entityManager->persist($blockTranslation);
        $this->entityManager->flush();
    }

    public function edit(EditItemInterface $editItem, $entity)
    {
        $entity = $this->projectBlockMapper->editProjectBlockDTOtoEntity($editItem, $entity);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function edit_translation(EditItemTranslationInterface $editItemTranslation, $translation, $entity, Locale $locale)
    {
        $translation = $this->projectBlockMapper->editProjectBlockTranslationDTOtoEntity($editItemTranslation, $translation, $entity, $locale);
        $this->entityManager->persist($translation);
        $this->entityManager->flush();
    }

    public function remove($entity)
    {
        /** @var ProjectBlock $entity */
        if($entity->getImage())
            $this->uploadFileService->remove($entity->getImage());

        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}