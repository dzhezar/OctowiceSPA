<?php


namespace App\Service\Blog;


use App\Entity\Blog;
use App\Entity\Locale;
use App\Mapper\BlogMapper;
use App\Repository\LocaleRepository;
use App\Service\ItemEditor\CreateItemInterface;
use App\Service\ItemEditor\EditItemInterface;
use App\Service\ItemEditor\EditItemTranslationInterface;
use App\Service\ItemEditor\EntityEditorInterface;
use App\Service\UploadFile\UploadFileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

class BlogService implements BlogServiceInterface, EntityEditorInterface
{

    private $uploadFileService;
    private $entityManager;
    private $localeRepository;
    private $blogMapper;


    /**
     * BlogService constructor.
     * @param UploadFileService $uploadFileService
     * @param EntityManagerInterface $entityManager
     * @param LocaleRepository $localeRepository
     * @param BlogMapper $blogMapper
     */
    public function __construct(UploadFileService $uploadFileService, EntityManagerInterface $entityManager, LocaleRepository $localeRepository, BlogMapper $blogMapper)
    {
        $this->uploadFileService = $uploadFileService;
        $this->entityManager = $entityManager;
        $this->localeRepository = $localeRepository;
        $this->blogMapper = $blogMapper;
    }

    public function create(CreateItemInterface $createItem, $block = null)
    {
        $locale_ru = $this->localeRepository->findOneBy(['short_name' => 'ru']);
        if(!$locale_ru)
            throw new Exception('Russian not found');

        $blog = $this->blogMapper->createBlogDTOtoEntity($createItem);
        $this->entityManager->persist($blog);
        $this->entityManager->flush();

        $translation = $this->blogMapper->createBlogDTOtoTranslationEntity($createItem, $locale_ru, $blog);
        $this->entityManager->persist($translation);
        $this->entityManager->flush();
    }

    public function edit(EditItemInterface $editItem, $entity)
    {
        $entity = $this->blogMapper->editBlogDTOtoEntity($editItem, $entity);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function edit_translation(EditItemTranslationInterface $editItemTranslation, $translation, $entity, Locale $locale)
    {
        $translation = $this->blogMapper->editBlogTranslationDTOtoEntity($editItemTranslation, $translation, $entity, $locale);
        $this->entityManager->persist($translation);
        $this->entityManager->flush();
    }

    public function remove($entity)
    {
        /** @var Blog $entity */
        if($entity->getImage())
            $this->uploadFileService->remove($entity->getImage());

        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}