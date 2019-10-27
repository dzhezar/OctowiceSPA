<?php


namespace App\Controller\Admin;


use App\Entity\Locale;
use App\Repository\LocaleRepository;
use App\Service\Language\LanguageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LocaleController extends AbstractController
{
    public function index(LocaleRepository $localeRepository)
    {
        return $this->render('admin/locale/index.html.twig', ['locales' => $localeRepository->findAll()]);
    }

    public function edit_locale_text(Locale $locale)
    {
        return $this->render('admin/locale/edit_locale_text.twig', ['locale' => $locale]);
    }

    public function edit_locale_text_action(Locale $locale, Request $request, LanguageService $languageService)
    {
        $array = $request->get('array');
        if($array)
            $languageService->updateFile($locale, $array);
        return new Response(null);
    }

    public function get_locale_text(Locale $locale, LanguageService $languageService, LocaleRepository $localeRepository)
    {
        $array = $languageService->parseFile($locale);
        if(!$array)
            $array = $languageService->parseFile($localeRepository->findOneBy(['short_name' => 'ru']));

        return new JsonResponse($array);
    }
}