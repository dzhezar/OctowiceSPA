<?php


namespace App\Service\Blog;


use App\DTO\CreateBlogDto;
use App\DTO\EditBlogDTO;
use App\DTO\EditBlogTranslationDTO;
use App\Entity\Blog;
use App\Entity\BlogTranslation;
use App\Entity\Locale;
use App\Repository\LocaleRepository;
use App\Service\ItemEditor\CreateItemInterface;
use App\Service\ItemEditor\EditItemInterface;
use App\Service\ItemEditor\EditItemTranslationInterface;
use App\Service\ItemEditor\EntityEditorInterface;
use App\Service\UploadFile\UploadFileService;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManagerInterface;

class BlogService implements BlogServiceInterface, EntityEditorInterface
{
    /**
     * @var UploadFileService
     */
    private $uploadFileService;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var LocaleRepository
     */
    private $localeRepository;


    /**
     * BlogService constructor.
     * @param UploadFileService $uploadFileService
     * @param EntityManagerInterface $entityManager
     * @param LocaleRepository $localeRepository
     */
    public function __construct(UploadFileService $uploadFileService, EntityManagerInterface $entityManager, LocaleRepository $localeRepository)
    {
        $this->uploadFileService = $uploadFileService;
        $this->entityManager = $entityManager;
        $this->localeRepository = $localeRepository;
    }

    public function create(CreateItemInterface $createItem, $block = null)
    {
        /** @var CreateBlogDto $data */
        $data = $createItem;
        $blog = new Blog();

        if($data->getImage()){
            $filename = $this->uploadFileService->upload($data->getImage());
            $blog->setImage($filename);
        }
        $slugify = new Slugify();
        $blog->setSlug($slugify->slugify($data->getName()))
            ->setSeoTitle($data->getSeoTitle())
            ->setSeoDescription($data->getSeoDescription());

        $this->entityManager->persist($blog);
        $this->entityManager->flush();

        $locale_ru = $this->localeRepository->findOneBy(['short_name' => 'ru']);
        $translation = new BlogTranslation();
        $translation->setName($data->getName())
            ->setDescription($data->getDescription())
            ->setLocale($locale_ru)
            ->setBlog($blog);

        $this->entityManager->persist($translation);
        $this->entityManager->flush();
    }

    public function edit(EditItemInterface $editItem, $entity)
    {
        /** @var EditBlogDTO $data */
        $data = $editItem;
        /** @var Blog $entity */

        if($data->getImage()){
            if($entity->getImage())
                $this->uploadFileService->remove($entity->getImage());
            $fileName = $this->uploadFileService->upload($data->getImage());
            $entity->setImage($fileName);
        }

        $entity->setSeoTitle($data->getSeoTitle())
            ->setSeoDescription($data->getSeoDescription());

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function edit_translation(EditItemTranslationInterface $editItemTranslation, $translation, $entity, Locale $locale)
    {
        /** @var EditBlogTranslationDTO $data */
        $data = $editItemTranslation;
        if(!$translation){
            $translation = new BlogTranslation();
            $translation->setBlog($entity);
            $translation->setLocale($locale);
        }

        $translation->setName($data->getName())
            ->setDescription($data->getDescription());

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