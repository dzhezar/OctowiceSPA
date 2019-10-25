<?php


namespace App\Controller\Admin;


use App\Entity\Blog;
use App\Entity\Locale;
use App\Form\CreateBlogForm;
use App\Repository\BlogRepository;
use App\Repository\LocaleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends AbstractController
{


    public function index(LocaleRepository $localeRepository, BlogRepository $blogRepository)
    {
        $locales = $localeRepository->getAllLanguages();
        $blogs = $blogRepository->getBlogs();


        return $this->render('admin/blog/index.html.twig', ['locales' => $locales, 'blogs' => $blogs]);
    }

    public function create_service(Request $request)
    {
        $form = $this->createForm(CreateBlogForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            dd($data);
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView()]);
    }

    public function edit_service(Blog $id)
    {
        dd($id);
    }

    public function edit_service_translation(Blog $blog, Locale $locale)
    {
        dd($blog, $locale);
    }
}