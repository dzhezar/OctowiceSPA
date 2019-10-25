<?php


namespace App\Controller\Admin;


use App\DTO\CreateBlogDto;
use App\DTO\EditBlogDTO;
use App\DTO\EditBlogTranslationDTO;
use App\Entity\Blog;
use App\Entity\BlogTranslation;
use App\Entity\Locale;
use App\Form\CreateBlogForm;
use App\Form\EditBlogForm;
use App\Form\EditBlogTranslationForm;
use App\Mapper\BlogMapper;
use App\Repository\BlogRepository;
use App\Repository\BlogTranslationRepository;
use App\Repository\LocaleRepository;
use App\Service\UploadFile\UploadFileService;
use Cocur\Slugify\Slugify;
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
     * BlogController constructor.
     * @param EntityManagerInterface $entityManager
     * @param BlogMapper $blogMapper
     */
    public function __construct(EntityManagerInterface $entityManager, BlogMapper $blogMapper)
    {
        $this->entityManager = $entityManager;
        $this->blogMapper = $blogMapper;
    }

    public function index(LocaleRepository $localeRepository, BlogRepository $blogRepository)
    {
        $locales = $localeRepository->getAllLanguages();
        $blogs = $blogRepository->getBlogs();

        return $this->render('admin/blog/index.html.twig', ['locales' => $locales, 'blogs' => $blogs]);
    }

    public function create_service(Request $request, UploadFileService $uploadFileService, LocaleRepository $localeRepository)
    {
        $form = $this->createForm(CreateBlogForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var CreateBlogDto $data */
            $data = $form->getData();
            $blog = new Blog();

            if($data->getImage()){
                $filename = $uploadFileService->upload($data->getImage());
                $blog->setImage($filename);
            }
            $slugify = new Slugify();
            $blog->setSlug($slugify->slugify($data->getName()))
                    ->setSeoTitle($data->getSeoTitle())
                    ->setSeoDescription($data->getSeoDescription());

            $this->entityManager->persist($blog);
            $this->entityManager->flush();

            $locale_ru = $localeRepository->findOneBy(['short_name' => 'ru']);
            $translation = new BlogTranslation();
            $translation->setName($data->getName())
                ->setDescription($data->getDescription())
                ->setLocale($locale_ru)
                ->setBlog($blog);

            $this->entityManager->persist($translation);
            $this->entityManager->flush();

            return $this->redirectToRoute('blog_main');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView()]);
    }

    public function edit_service(Blog $blog, Request $request, UploadFileService $uploadFileService)
    {
        $dto = $this->blogMapper->EntityToEditBlogDTO($blog);
        $form = $this->createForm(EditBlogForm::class, $dto);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            /** @var EditBlogDTO $data */
            $data = $form->getData();
            if($data->getImage()){
                if($blog->getImage())
                    $uploadFileService->remove($blog->getImage());
                $fileName = $uploadFileService->upload($data->getImage());
                $blog->setImage($fileName);
            }

            $blog->setSeoTitle($data->getSeoTitle())
                ->setSeoDescription($data->getSeoDescription());

            $this->entityManager->persist($blog);
            $this->entityManager->flush();

            return $this->redirectToRoute('blog_main');
        }

        return $this->render('admin/blog/edit_blog.html.twig', ['form' => $form->createView(), 'image' => $blog->getImage()]);

    }

    public function edit_service_translation(Blog $blog, Locale $locale, Request $request, BlogTranslationRepository $blogTranslationRepository)
    {
        $translation = $blogTranslationRepository->getBlogByIdAndLocale($blog->getId(), $locale->getId());
        if(!isset($translation[0]))
            $translation = null;
        elseif($translation)
            $translation = $translation[0];

        $form = $this->createForm(EditBlogTranslationForm::class, $this->blogMapper->entityToEditBlogTranslationDTO($translation));
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var EditBlogTranslationDTO $data */
            $data = $form->getData();
            if(!$translation){
                $translation = new BlogTranslation();
                $translation->setBlog($blog);
                $translation->setLocale($locale);
            }

            $translation->setName($data->getName())
                ->setDescription($data->getDescription());

            $this->entityManager->persist($translation);
            $this->entityManager->flush();

            return $this->redirectToRoute('blog_main');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView()]);
    }
}