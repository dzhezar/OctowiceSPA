<?php


namespace App\Controller\Admin;


use App\DTO\CreateServiceDTO;
use App\DTO\EditServiceDTO;
use App\DTO\EditServiceTranslationDTO;
use App\Entity\Locale;
use App\Entity\Service;
use App\Entity\ServiceTranslation;
use App\Form\CreateServiceForm;
use App\Form\EditServiceForm;
use App\Form\EditServiceTranslationForm;
use App\Mapper\ServiceMapper;
use App\Mapper\ServiceTranslationMapper;
use App\Repository\LocaleRepository;
use App\Repository\ServiceRepository;
use App\Repository\ServiceTranslationRepository;
use App\Service\Service\ServiceService;
use App\Service\UploadFile\UploadFileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ServiceTranslationRepository
     */
    private $serviceTranslationRepository;
    /**
     * @var ServiceService
     */
    private $serviceService;


    /**
     * ServiceController constructor.
     * @param EntityManagerInterface $entityManager
     * @param ServiceTranslationRepository $serviceTranslationRepository
     * @param ServiceService $serviceService
     */
    public function __construct(EntityManagerInterface $entityManager, ServiceTranslationRepository $serviceTranslationRepository, ServiceService $serviceService)
    {
        $this->entityManager = $entityManager;
        $this->serviceTranslationRepository = $serviceTranslationRepository;
        $this->serviceService = $serviceService;
    }

    public function index(ServiceRepository $serviceRepository, LocaleRepository $localeRepository)
    {
        return $this->render('admin/service/index.html.twig', ['locales' => $localeRepository->getAllLanguages(), 'services' => $serviceRepository->getServicesInRussian()]);
        
    }

    public function create_service(Request $request)
    {
        $form = $this->createForm(CreateServiceForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->serviceService->create($form->getData());
            return $this->redirectToRoute('service_main');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView()]);
    }

    public function edit_service(Service $id, Request $request, ServiceMapper $serviceMapper)
    {
        $form = $this->createForm(EditServiceForm::class, $serviceMapper->entityToEditServiceDTO($id));
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->serviceService->edit($form->getData(), $id);
            return $this->redirectToRoute('service_main');
        }

        return $this->render('admin/service/edit_service.html.twig', ['form' => $form->createView(), 'image' => $id->getImage()]);
    }

    public function edit_service_translation(Service $service, Locale $locale, ServiceTranslationMapper $mapper, Request $request)
    {
        $translation = $this->serviceTranslationRepository->findByProjectAndLocale($service->getId(), $locale->getId());
        if(!isset($translation[0]))
            $translation = null;
        elseif($translation)
            $translation = $translation[0];

        $form = $this->createForm(EditServiceTranslationForm::class, $mapper->entityToEditServiceTranslationDTO($translation));
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->serviceService->edit_translation($form->getData(), $translation, $service, $locale);
            return $this->redirectToRoute('service_main');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView()]);
    }

    public function remove_service(Service $service)
    {
        $this->serviceService->remove($service);
        return $this->redirectToRoute('service_main');
    }

    public function switch_service(Service $id, bool $bool)
    {
        $id->setIsOnServicePage($bool);
        $this->entityManager->persist($id);
        $this->entityManager->flush();

        return new Response(null);
    }
}