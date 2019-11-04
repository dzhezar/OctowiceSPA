<?php


namespace App\Controller\Admin;


use App\DTO\CreateProjectBlockDTO;
use App\DTO\EditProjectBlockDTO;
use App\DTO\EditProjectBlockTranslationDTO;
use App\DTO\EditProjectTranslationDTO;
use App\Entity\Locale;
use App\Entity\Project;
use App\Entity\ProjectBlock;
use App\Entity\ProjectBlockTranslation;
use App\Form\CreateProjectBlock;
use App\Form\EditProjectBlockForm;
use App\Form\EditProjectBlockTranslationForm;
use App\Mapper\ProjectBlockMapper;
use App\Repository\LocaleRepository;
use App\Repository\ProjectBlockRepository;
use App\Repository\ProjectBlockTranslationRepository;
use App\Repository\ProjectRepository;
use App\Repository\ProjectTranslationRepository;
use App\Service\UploadFile\UploadFileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProjectBlockController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ProjectBlockRepository
     */
    private $projectBlockRepository;


    /**
     * ProjectBlockController constructor.
     * @param EntityManagerInterface $entityManager
     * @param ProjectBlockRepository $projectBlockRepository
     */
    public function __construct(EntityManagerInterface $entityManager, ProjectBlockRepository $projectBlockRepository)
    {
        $this->entityManager = $entityManager;
        $this->projectBlockRepository = $projectBlockRepository;
    }

    public function index(Project $project, LocaleRepository $localeRepository, ProjectTranslationRepository $projectTranslationRepository)
    {
        $project_translation = $projectTranslationRepository->findOneBy(['project' => $project, 'locale' => $localeRepository->findOneBy(['short_name' => 'ru'])]);
        if($project_translation)
            $project_translation = $project_translation->getName();

        $blocks = $this->projectBlockRepository->getBlocksByProjectId($project->getId());
        $locales = $localeRepository->getAllLanguages();

        return $this->render('admin/block/index.html.twig', ['locales' => $locales, 'blocks' => $blocks, 'project_id' => $project->getId(), 'project_name' => $project_translation]);
    }

    public function project_block_create(Project $project, Request $request, UploadFileService $uploadFileService, LocaleRepository $localeRepository)
    {
        $form = $this->createForm(CreateProjectBlock::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $queue = $this->projectBlockRepository->getLastQueue();
            if($queue)
                $queue = $queue[0]['queue']+1;
            if(!$queue)
                $queue = 1;
            $locale_ru = $localeRepository->findOneBy(['short_name' => 'ru']);
            if(!$locale_ru)
                throw new Exception('Russian locale not found');
            /** @var CreateProjectBlockDTO $data */
            $data = $form->getData();
            $block = new ProjectBlock();
            if($data->getImage()){
                $fileName = $uploadFileService->upload($data->getImage());
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

            return $this->redirectToRoute('project_block_main', ['project' => $project->getId()]);
        }

        return $this->render('admin/block/create_block.html.twig', ['form' => $form->createView()]);
    }

    public function project_block_edit(ProjectBlock $block, Request $request, ProjectBlockMapper $projectBlockMapper, UploadFileService $uploadFileService)
    {
        $form = $this->createForm(EditProjectBlockForm::class, $projectBlockMapper->entityToEditProjectBlockDTO($block));
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var EditProjectBlockDTO $data */
            $data = $form->getData();
            if($data->getImage()){
                if($block->getImage())
                    $uploadFileService->remove($block->getImage());
                $fileName = $uploadFileService->upload($data->getImage());
                $block->setImage($fileName);
            }
            $block->setColor($data->getColor());
            $block->setColorText($data->getColorText());
            $this->entityManager->persist($block);
            $this->entityManager->flush();

            return $this->redirectToRoute('project_block_main', ['project' => $block->getProject()->getId()]);
        }

        return $this->render('admin/block/edit_block.html.twig', ['form' => $form->createView(), 'image' => $block->getImage()]);
    }

    public function project_block_edit_translation(ProjectBlock $block, Locale $locale, ProjectBlockTranslationRepository $projectBlockTranslationRepository, ProjectBlockMapper $projectBlockMapper, Request $request)
    {
        $translation_found = $projectBlockTranslationRepository->getTranslationByProjectAndLocaleID($block->getId(), $locale->getId());

        if(!$translation_found)
            $translation = new EditProjectTranslationDTO();
        else
            $translation = $projectBlockMapper->entityToEditProjectBlockTranslationDTO($translation_found[0]);

        $form = $this->createForm(EditProjectBlockTranslationForm::class, $translation);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var EditProjectBlockTranslationDTO $data */
            $data = $form->getData();

            if(!$translation_found) {
                $translation_found = new ProjectBlockTranslation();
                $translation_found->setProjectBlock($block)
                    ->setLocale($locale);
            }
            else
                $translation_found = $translation_found[0];

            $translation_found->setName($data->getName())
                ->setDescription($data->getDescription());

            $this->entityManager->persist($translation_found);
            $this->entityManager->flush();

            return $this->redirectToRoute('project_block_main', ['project' => $block->getProject()->getId()]);
        }

        return $this->render('admin/block/edit_block_translation.html.twig', ['form' => $form->createView()]);
    }

    public function project_block_remove(ProjectBlock $block, UploadFileService $uploadFileService)
    {
        if($block->getImage())
            $uploadFileService->remove($block->getImage());

        $this->entityManager->remove($block);
        $this->entityManager->flush();

        return $this->redirectToRoute('project_block_main', ['project' => $block->getProject()->getId()]);
    }

    public function change_order_block(Request $request)
    {
        $order = $request->get('order');
        foreach ($order as $key => $item){
            $category = $this->projectBlockRepository->findOneBy(['id' => $item]);
            if($category){
                $category->setQueue($key+1);
            }

            $this->entityManager->persist($category);
            $this->entityManager->flush();
        }

        return new Response(null);
    }
}