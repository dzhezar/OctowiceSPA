<?php


namespace App\Controller\Admin;


use App\Entity\Blog;
use App\Entity\Locale;
use App\Form\CreateBlogForm;
use App\Form\EditBlogForm;
use App\Form\EditBlogTranslationForm;
use App\Mapper\BlogMapper;
use App\Repository\BlogRepository;
use App\Repository\BlogTranslationRepository;
use App\Repository\LocaleRepository;
use App\Service\Blog\BlogService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var BlogMapper
     */
    private $blogMapper;
    /**
     * @var BlogService
     */
    private $blogService;


    /**
     * BlogController constructor.
     * @param EntityManagerInterface $entityManager
     * @param BlogMapper $blogMapper
     * @param BlogService $blogService
     */
    public function __construct(EntityManagerInterface $entityManager, BlogMapper $blogMapper, BlogService $blogService)
    {
        $this->entityManager = $entityManager;
        $this->blogMapper = $blogMapper;
        $this->blogService = $blogService;
    }

    public function index(LocaleRepository $localeRepository, BlogRepository $blogRepository)
    {
        $locales = $localeRepository->getAllLanguages();
        $blogs = $blogRepository->getBlogs();

        return $this->render('admin/blog/index.html.twig', ['locales' => $locales, 'blogs' => $blogs]);
    }

    public function create_blog(Request $request)
    {
        $form = $this->createForm(CreateBlogForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->blogService->create($form->getData());
            return $this->redirectToRoute('blog_main');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView()]);
    }

    public function edit_blog(Blog $blog, Request $request)
    {
        $dto = $this->blogMapper->EntityToEditBlogDTO($blog);
        $form = $this->createForm(EditBlogForm::class, $dto);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $this->blogService->edit($form->getData(), $blog);

            return $this->redirectToRoute('blog_main');
        }

        return $this->render('admin/blog/edit_blog.html.twig', ['form' => $form->createView(), 'image' => $blog->getImage()]);
    }

    public function edit_blog_translation(Blog $blog, Locale $locale, Request $request, BlogTranslationRepository $blogTranslationRepository)
    {
        $translation = $blogTranslationRepository->getBlogByIdAndLocale($blog->getId(), $locale->getId());
        if(!isset($translation[0]))
            $translation = null;
        elseif($translation)
            $translation = $translation[0];

        $form = $this->createForm(EditBlogTranslationForm::class, $this->blogMapper->entityToEditBlogTranslationDTO($translation));
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->blogService->edit_translation($form->getData(), $translation, $blog, $locale);

            return $this->redirectToRoute('blog_main');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView()]);
    }

    public function remove_blog(Blog $blog)
    {
        $this->blogService->remove($blog);

        return $this->redirectToRoute('blog_main');
    }
}