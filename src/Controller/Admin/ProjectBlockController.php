<?php


namespace App\Controller\Admin;


use App\DTO\EditProjectBlockTranslationDTO;
use App\DTO\EditProjectTranslationDTO;
use App\Entity\Locale;
use App\Entity\Project;
use App\Entity\ProjectBlock;
use App\Form\CreateProjectBlock;
use App\Form\EditProjectBlockForm;
use App\Form\EditProjectBlockTranslationForm;
use App\Mapper\ProjectBlockMapper;
use App\Repository\LocaleRepository;
use App\Repository\ProjectBlockRepository;
use App\Repository\ProjectBlockTranslationRepository;
use App\Repository\ProjectTranslationRepository;
use App\Service\ProjectBlock\ProjectBlockService;
use App\Service\UploadFile\UploadFileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @var ProjectBlockService
     */
    private $projectBlockServiceService;


    /**
     * ProjectBlockController constructor.
     * @param EntityManagerInterface $entityManager
     * @param ProjectBlockRepository $projectBlockRepository
     * @param ProjectBlockService $projectBlockServiceService
     */
    public function __construct(EntityManagerInterface $entityManager, ProjectBlockRepository $projectBlockRepository, ProjectBlockService $projectBlockServiceService)
    {
        $this->entityManager = $entityManager;
        $this->projectBlockRepository = $projectBlockRepository;
        $this->projectBlockServiceService = $projectBlockServiceService;
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

    public function project_block_create(Project $project, Request $request)
    {
        $form = $this->createForm(CreateProjectBlock::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->projectBlockServiceService->create($form->getData(), $project);
            return $this->redirectToRoute('project_block_main', ['project' => $project->getId()]);
        }

        return $this->render('admin/block/create_block.html.twig', ['form' => $form->createView()]);
    }

    public function project_block_edit(ProjectBlock $block, Request $request, ProjectBlockMapper $projectBlockMapper)
    {
        $form = $this->createForm(EditProjectBlockForm::class, $projectBlockMapper->entityToEditProjectBlockDTO($block));
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->projectBlockServiceService->edit($form->getData(), $block);

            return $this->redirectToRoute('project_block_main', ['project' => $block->getProject()->getId()]);
        }

        return $this->render('admin/block/edit_block.html.twig', ['form' => $form->createView(), 'image' => $block->getImage()]);
    }

    public function project_block_edit_translation(ProjectBlock $block, Locale $locale, ProjectBlockTranslationRepository $projectBlockTranslationRepository, ProjectBlockMapper $projectBlockMapper, Request $request)
    {
        $translation_found = $projectBlockTranslationRepository->getTranslationByProjectAndLocaleID($block->getId(), $locale->getId());

        if(!$translation_found){
            $translation = new EditProjectBlockTranslationDTO(null, null);
            $translation_found = null;
        }
        else{
            $translation = $projectBlockMapper->entityToEditProjectBlockTranslationDTO($translation_found[0]);
            $translation_found = $translation_found[0];
        }



        $form = $this->createForm(EditProjectBlockTranslationForm::class, $translation);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->projectBlockServiceService->edit_translation($form->getData(), $translation_found, $block, $locale);
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