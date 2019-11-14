<?php


namespace App\Mapper;


use App\DTO\CreateProjectBlockDTO;
use App\DTO\EditProjectBlockDTO;
use App\DTO\EditProjectBlockTranslationDTO;
use App\DTO\EditProjectTranslationDTO;
use App\Entity\Locale;
use App\Entity\Project;
use App\Entity\ProjectBlock;
use App\Entity\ProjectBlockTranslation;
use App\Repository\LocaleRepository;
use App\Repository\ProjectBlockRepository;
use App\Service\UploadFile\UploadFileService;
use Symfony\Component\Config\Definition\Exception\Exception;

class ProjectBlockMapper
{
    /**
     * @var ProjectBlockRepository
     */
    private $projectBlockRepository;
    /**
     * @var LocaleRepository
     */
    private $localeRepository;
    /**
     * @var UploadFileService
     */
    private $uploadFileService;


    /**
     * ProjectBlockMapper constructor.
     * @param ProjectBlockRepository $projectBlockRepository
     * @param LocaleRepository $localeRepository
     * @param UploadFileService $uploadFileService
     */
    public function __construct(ProjectBlockRepository $projectBlockRepository, LocaleRepository $localeRepository, UploadFileService $uploadFileService)
    {
        $this->projectBlockRepository = $projectBlockRepository;
        $this->localeRepository = $localeRepository;
        $this->uploadFileService = $uploadFileService;
    }

    public function entityToEditProjectBlockDTO(ProjectBlock $block): EditProjectBlockDTO
    {
        return new EditProjectBlockDTO(
            $block->getColor(),
            $block->getColorText()
        );
    }

    public function entityToEditProjectBlockTranslationDTO(ProjectBlockTranslation $block): EditProjectBlockTranslationDTO
    {
        return new EditProjectBlockTranslationDTO(
            $block->getName(),
            $block->getDescription()
        );
    }

    public function createProjectBlockDTOtoEntity(CreateProjectBlockDTO $projectBlockDTO, Project $project): ProjectBlock
    {
        $queue = $this->projectBlockRepository->getLastQueue();
        if($queue)
            $queue = $queue[0]['queue']+1;
        if(!$queue)
            $queue = 1;
        /** @var CreateProjectBlockDTO $data */
        $data = $projectBlockDTO;
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

        return $block;
    }

    public function createProjectBlockTranslationDTOtoEntity(CreateProjectBlockDTO $projectBlockDTO, ProjectBlock $projectBlock, Locale $locale): ProjectBlockTranslation
    {
        $blockTranslation = new ProjectBlockTranslation();
        $blockTranslation->setDescription($projectBlockDTO->getDescription())
            ->setName($projectBlockDTO->getName())
            ->setLocale($locale)
            ->setProjectBlock($projectBlock);

        return $blockTranslation;
    }

    public function editProjectBlockDTOtoEntity(EditProjectBlockDTO $projectBlockDTO, ProjectBlock $projectBlock): ProjectBlock
    {
        if($projectBlockDTO->getImage()){
            if($projectBlock->getImage())
                $this->uploadFileService->remove($projectBlock->getImage());
            $fileName = $this->uploadFileService->upload($projectBlockDTO->getImage());
            $projectBlock->setImage($fileName);
        }
        $projectBlock->setColor($projectBlockDTO->getColor());
        $projectBlock->setColorText($projectBlockDTO->getColorText());

        return $projectBlock;
    }

    public function editProjectBlockTranslationDTOtoEntity(EditProjectBlockTranslationDTO $blockTranslationDTO, ?ProjectBlockTranslation $translation, ProjectBlock $entity, Locale $locale): ProjectBlockTranslation
    {
        if(!$translation) {
            $translation = new ProjectBlockTranslation();
            $translation->setProjectBlock($entity)
                ->setLocale($locale);
        }

        $translation->setName($blockTranslationDTO->getName())
            ->setDescription($blockTranslationDTO->getDescription());

        return $translation;
    }
}