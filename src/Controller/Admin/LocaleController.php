<?php


namespace App\Controller\Admin;


use App\Repository\LocaleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LocaleController extends AbstractController
{
    public function index(LocaleRepository $localeRepository)
    {
        return $this->render('admin/locale/index.html.twig', ['locales' => $localeRepository->findAll()]);
    }
}