<?php


namespace App\Controller\Api;


use App\Repository\LocaleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class MainApiController extends AbstractController
{
    public function getLanguages(LocaleRepository $localeRepository)
    {
        return new JsonResponse($localeRepository->getAllLanguages());
    }

}