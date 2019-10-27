<?php


namespace App\Controller\Admin;


use App\Entity\Locale;
use App\Form\CreateLocaleForm;
use App\Repository\LocaleRepository;
use App\Service\Language\LanguageService;
use Doctrine\ORM\EntityManagerInterface;
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

    public function remove_locale(Locale $locale, EntityManagerInterface $entityManager, LanguageService $languageService)
    {
        if($locale->getShortName() === 'ru')
            return $this->redirectToRoute('locale_main');

        $languageService->removeFile($locale);

        $entityManager->remove($locale);
        $entityManager->flush();

        return $this->redirectToRoute('locale_main');
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

    public function create_locale(Request $request, LocaleRepository $localeRepository, LanguageService $languageService, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(CreateLocaleForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var Locale $locale */
            $locale = $form->getData();
            $ru_locale = $localeRepository->findOneBy(['short_name' => 'ru']);
            if($localeRepository->findOneBy(['short_name' => $locale->getShortName()]))
                return $this->render('admin/form.html.twig', ['form' => $form->createView(), 'text' => 'Такой язык уже существует']);

            $languageService->updateFile($locale, $languageService->parseFile($ru_locale));

            $entityManager->persist($locale);
            $entityManager->flush();

            return $this->redirectToRoute('locale_main');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView()]);
    }

    public function edit_locale(Locale $locale, Request $request, EntityManagerInterface $entityManager)
    {
        if($locale->getShortName() === 'ru')
            return $this->redirectToRoute('locale_main');

        $form = $this->createForm(CreateLocaleForm::class, $locale);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($locale);
            $entityManager->flush();

            return $this->redirectToRoute('locale_main');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView()]);


    }
}