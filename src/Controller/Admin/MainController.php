<?php


namespace App\Controller\Admin;


use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{
    public function index()
    {
        return $this->render('admin/base.html.twig');
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
}