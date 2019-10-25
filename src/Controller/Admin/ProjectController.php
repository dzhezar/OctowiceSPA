<?php


namespace App\Controller\Admin;


use App\DTO\CreateProjectDTO;
use App\DTO\EditCategoryDTO;
use App\DTO\EditProjectDTO;
use App\Entity\Category;
use App\Entity\CategoryTranslation;
use App\Entity\Locale;
use App\Entity\Project;
use App\Entity\ProjectImage;
use App\Entity\ProjectTranslation;
use App\Form\CreateProjectForm;
use App\Form\EditCategoryForm;
use App\Form\EditProjectForm;
use App\Form\EditProjectTranslationForm;
use App\Mapper\CategoryMapper;
use App\Mapper\ProjectMapper;
use App\Repository\CategoryRepository;
use App\Repository\LocaleRepository;
use App\Repository\ProjectRepository;
use App\Repository\ProjectTranslationRepository;
use App\Repository\ServiceRepository;
use App\Service\UploadFile\UploadFileService;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * ProjectController constructor.
     * @param EntityManagerInterface $entityManager
     * @param ProjectMapper $projectMapper
     */
    public function __construct(EntityManagerInterface $entityManager, ProjectMapper $projectMapper)
    {
        $this->entityManager = $entityManager;
        $this->projectMapper = $projectMapper;
    }

    public function create_project(Request $request, CategoryRepository $categoryRepository, CategoryMapper $categoryMapper, UploadFileService $uploadedFile, LocaleRepository $localeRepository)
    {
        $categories = $categoryRepository->getCategoriesNameInRussian();
        $categories = $categoryMapper->arrayToCategoryNameDTO($categories);

        $form = $this->createForm(CreateProjectForm::class, null, ['categories' => $categories]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var CreateProjectDTO $data */
            $data = $form->getData();
            $id = new Project();
            $category = $categoryRepository->findOneBy(['id' => $data->getCategory()->getId()]);
            if($category)
                $id->setCategory($category);
            if($data->getImage()){
                $newFileName = $uploadedFile->upload($data->getImage());
                $id->setImage($newFileName);
            }
            $id->setSeoDescription($data->getSeoDescription())
                ->setLink($data->getLink())
                ->setSeoTitle($data->getSeoTitle());
                $slugify = new Slugify();
                $id->setSlug($slugify->slugify($data->getName()));
            $this->entityManager->persist($id);
            $this->entityManager->flush();
            $locale = $localeRepository->findOneBy(['short_name' => 'ru']);
            if(!$locale)
                throw new Exception('no russian language');
            $translation = new ProjectTranslation();
            $translation->setName($data->getName())
                ->setProject($id)
                ->setDescription($data->getDescription())
                ->setLocale($locale);
            $this->entityManager->persist($translation);
            $this->entityManager->flush();
            return $this->redirectToRoute('project_main');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView()]);
    }

    public function index(ProjectRepository $projectRepository, LocaleRepository $localeRepository)
    {
        return $this->render('admin/project/index.html.twig', ['projects' => $projectRepository->getProjectsInRussian(), 'locales' => $localeRepository->getAllLanguages()]);
    }

    public function remove_project(Project $project, UploadFileService $uploadFileService)
    {
        $uploadFileService->remove($project->getImage());
        $this->entityManager->remove($project);
        $this->entityManager->flush();
        return $this->redirectToRoute('project_main');
    }

    public function edit_project(Project $id, Request $request, UploadFileService $uploadedFile, CategoryRepository $categoryRepository, CategoryMapper $categoryMapper)
    {
        $categories = $categoryRepository->getCategoriesNameInRussian();
        $categories = $categoryMapper->arrayToCategoryNameDTO($categories);

        $form = $this->createForm(EditProjectForm::class, $this->projectMapper->entityToEditProjectDTO($id), ['categories' => $categories]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var EditProjectDTO $data */
            $data = $form->getData();
            $category = $categoryRepository->findOneBy(['id' => $data->getCategory()->getId()]);
            if($category)
                $id->setCategory($category);
            if($data->getImage()){
                if($id->getImage())
                    $uploadedFile->remove($id->getImage());
                $newFileName = $uploadedFile->upload($data->getImage());
                $id->setImage($newFileName);
            }
            $id->setSeoDescription($data->getSeoDescription())
                ->setLink($data->getLink())
                ->setSeoTitle($data->getSeoTitle());
            $this->entityManager->persist($id);
            $this->entityManager->flush();
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
            $data = $form->getData();
            if(!$translation){
                $translation = new ProjectTranslation();
                $translation->setName($data->getName())
                    ->setDescription($data->getDescription())
                    ->setProject($project)
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

            return $this->redirectToRoute('project_main');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView()]);
    }
}