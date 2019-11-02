<?php


namespace App\Controller\Admin;


use App\Repository\CategoryRepository;
use App\Repository\MailRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{
    public function index()
    {
        return $this->redirectToRoute('show_mails');
    }

    public function change_order_category(Request $request, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager)
    {
        $order = $request->get('order');
        foreach ($order as $key => $item){
            $category = $categoryRepository->findOneBy(['id' => $item]);
            if($category){
                $category->setQueue($key+1);
            }

            $entityManager->persist($category);
            $entityManager->flush();
        }

        return new Response('', 200);
    }

    public function render_mails(MailRepository $repository)
    {
        return $this->render('admin/mail/index.html.twig', ['mails' => $repository->findBy([], ['created_at' => 'DESC'])]);
    }
}