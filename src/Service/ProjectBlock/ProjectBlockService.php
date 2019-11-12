<?php


namespace App\Service\ProjectBlock;


use App\DTO\CreateProjectBlockDTO;
use App\DTO\EditProjectBlockDTO;
use App\DTO\EditProjectBlockTranslationDTO;
use App\Entity\Locale;
use App\Entity\ProjectBlock;
use App\Entity\ProjectBlockTranslation;
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
     * ProjectBlockService constructor.
     * @param ProjectBlockRepository $projectBlockRepository
     * @param EntityManagerInterface $entityManager
     * @param LocaleRepository $localeRepository
     * @param UploadFileService $uploadFileService
     */
    public function __construct(ProjectBlockRepository $projectBlockRepository, EntityManagerInterface $entityManager, LocaleRepository $localeRepository, UploadFileService $uploadFileService)
    {
        $this->entityManager = $entityManager;
        $this->localeRepository = $localeRepository;
        $this->uploadFileService = $uploadFileService;
        $this->projectBlockRepository = $projectBlockRepository;
    }

    public function create(CreateItemInterface $createItem, $project = null)
    {
        $queue = $this->projectBlockRepository->getLastQueue();
        if($queue)
            $queue = $queue[0]['queue']+1;
        if(!$queue)
            $queue = 1;
        $locale_ru = $this->localeRepository->findOneBy(['short_name' => 'ru']);
        if(!$locale_ru)
            throw new Exception('Russian locale not found');
        /** @var CreateProjectBlockDTO $data */
        $data = $createItem;
        $block = new ProjectBlock();
        if($data->getImage()){
            $fileName = $this->uploadFileService->upload($data->getImage());
            $block->setImage($fileName);
        }
        if(!$data->getColor())
            $data->setColor('#FFFFFF');
        if(!$data->getColorText())
            $data->setColorText('#000000');

        $block->setColor($data->getColor())
            ->setColorText($data->getColorText())
            ->setProject($project)
            ->setQueue($queue);

        $this->entityManager->persist($block);
        $this->entityManager->flush();

        $blockTranslation = new ProjectBlockTranslation();
        $blockTranslation->setDescription($data->getDescription())
            ->setName($data->getName())
            ->setLocale($locale_ru)
            ->setProjectBlock($block);

        $this->entityManager->persist($blockTranslation);
        $this->entityManager->flush();
    }

    public function edit(EditItemInterface $editItem, $entity)
    {
        /** @var EditProjectBlockDTO $data */
        $data = $editItem;
        /** @var ProjectBlock $entity */
        if($data->getImage()){
            if($entity->getImage())
                $this->uploadFileService->remove($entity->getImage());
            $fileName = $this->uploadFileService->upload($data->getImage());
            $entity->setImage($fileName);
        }
        $entity->setColor($data->getColor());
        $entity->setColorText($data->getColorText());
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function edit_translation(EditItemTranslationInterface $editItemTranslation, $translation, $entity, Locale $locale)
    {
        /** @var EditProjectBlockTranslationDTO $data */
        $data = $editItemTranslation;

        if(!$translation) {
            $translation = new ProjectBlockTranslation();
            $translation->setProjectBlock($entity)
                ->setLocale($locale);
        }
        else
            $translation = $translation[0];

        $translation->setName($data->getName())
            ->setDescription($data->getDescription());

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