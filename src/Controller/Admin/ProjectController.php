<?php


namespace App\Controller\Admin;


use App\Entity\Locale;
use App\Entity\Project;
use App\Form\CreateProjectForm;
use App\Form\EditProjectForm;
use App\Form\EditProjectTranslationForm;
use App\Mapper\CategoryMapper;
use App\Mapper\ProjectMapper;
use App\Repository\CategoryRepository;
use App\Repository\LocaleRepository;
use App\Repository\ProjectRepository;
use App\Repository\ProjectTranslationRepository;
use App\Service\Project\ProjectService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ProjectController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ProjectMapper
     */
    private $projectMapper;
    /**
     * @var ProjectService
     */
    private $projectService;


    /**
     * ProjectController constructor.
     * @param EntityManagerInterface $entityManager
     * @param ProjectMapper $projectMapper
     * @param ProjectService $projectService
     */
    public function __construct(EntityManagerInterface $entityManager, ProjectMapper $projectMapper, ProjectService $projectService)
    {
        $this->entityManager = $entityManager;
        $this->projectMapper = $projectMapper;
        $this->projectService = $projectService;
    }

    public function index(ProjectRepository $projectRepository, LocaleRepository $localeRepository)
    {
        return $this->render('admin/project/index.html.twig', ['projects' => $projectRepository->getProjectsInRussian(), 'locales' => $localeRepository->getAllLanguages()]);
    }

    public function create_project(Request $request, CategoryRepository $categoryRepository, CategoryMapper $categoryMapper)
    {
        $categories = $categoryRepository->getCategoriesNameInRussian();
        $categories = $categoryMapper->arrayToCategoryNameDTO($categories);

        $form = $this->createForm(CreateProjectForm::class, null, ['categories' => $categories]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->projectService->create($form->getData());
            return $this->redirectToRoute('project_main');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView()]);
    }

    public function edit_project(Project $id, Request $request, CategoryRepository $categoryRepository, CategoryMapper $categoryMapper)
    {
        $categories = $categoryRepository->getCategoriesNameInRussian();
        $categories = $categoryMapper->arrayToCategoryNameDTO($categories);

        $form = $this->createForm(EditProjectForm::class, $this->projectMapper->entityToEditProjectDTO($id), ['categories' => $categories]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->projectService->edit($form->getData(), $id);
            return $this->redirectToRoute('project_main');
        }

        return $this->render('admin/project/edit_project.html.twig', ['form' => $form->createView(), 'image' => $id->getImage()]);
    }

    public function edit_project_translation(Project $project, Locale $locale, ProjectTranslationRepository $projectTranslationRepository, Request $request, ProjectMapper $projectMapper)
    {
        $translation = $projectTranslationRepository->findByProjectAndLocale($project->getId(), $locale->getId());

        if(!isset($translation[0]))
            $translation = null;
        elseif($translation)
            $translation = $translation[0];

        $form = $this->createForm(EditProjectTranslationForm::class, $projectMapper->entityToEditProjectTranslationDTO($translation));
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->projectService->edit_translation($form->getData(), $translation, $project, $locale);
            return $this->redirectToRoute('project_main');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView()]);
    }

    public function remove_project(Project $project)
    {
        $this->projectService->remove($project);
        return $this->redirectToRoute('project_main');
    }
}