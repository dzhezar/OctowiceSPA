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
     * ServiceController constructor.
     * @param EntityManagerInterface $entityManager
     * @param ServiceTranslationRepository $serviceTranslationRepository
     */
    public function __construct(EntityManagerInterface $entityManager, ServiceTranslationRepository $serviceTranslationRepository)
    {
        $this->entityManager = $entityManager;
        $this->serviceTranslationRepository = $serviceTranslationRepository;
    }

    public function index(ServiceRepository $serviceRepository, LocaleRepository $localeRepository)
    {
        return $this->render('admin/service/index.html.twig', ['locales' => $localeRepository->getAllLanguages(), 'services' => $serviceRepository->getServicesInRussian()]);
        
    }

    public function create_service(Request $request, LocaleRepository $localeRepository, UploadFileService $uploadFileService)
    {
        $form = $this->createForm(CreateServiceForm::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var CreateServiceDTO $data */
            $data = $form->getData();
            $locale_ru = $localeRepository->findOneBy(['short_name' => 'ru']);
            if(!$locale_ru)
                throw new Exception('No russian language');
            $service = new Service();
            $service->setPrice($data->getPrice())
                ->setIsOnServicePage($data->getIsOnServicePage());

            if($data->getImage()) {
                $fileName = $uploadFileService->upload($data->getImage());
                $service->setImage($fileName);
            }

            $this->entityManager->persist($service);
            $this->entityManager->flush();

            $translation = new ServiceTranslation();
            $translation->setLocale($locale_ru)
                ->setName($data->getName())
                ->setDescription($data->getDescription())
                ->setService($service);

            $this->entityManager->persist($translation);
            $this->entityManager->flush();

            return $this->redirectToRoute('service_main');


        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView()]);
    }

    public function edit_service(Service $id, Request $request, UploadFileService $uploadFileService, ServiceMapper $serviceMapper)
    {
        $form = $this->createForm(EditServiceForm::class, $serviceMapper->entityToEditServiceDTO($id));
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var EditServiceDTO $data */
            $data = $form->getData();
            $id->setPrice($data->getPrice())
                ->setIsOnServicePage($data->getIsOnServicePage());
            if($data->getImage()){
                if($id->getImage())
                    $uploadFileService->remove($id->getImage());
                $image = $uploadFileService->upload($data->getImage());
                $id->setImage($image);
            }
            $this->entityManager->persist($id);
            $this->entityManager->flush();

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
            /** @var EditServiceTranslationDTO $data */
            $data = $form->getData();
            if(!$translation){
                $translation = new ServiceTranslation();
                $translation
                    ->setLocale($locale)
                    ->setService($service);
            }
            $translation->setName($data->getName())
                ->setDescription($data->getDescription());

            $this->entityManager->persist($translation);
            $this->entityManager->flush();

            return $this->redirectToRoute('service_main');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView()]);
    }

    public function remove_service(Service $service, UploadFileService $uploadFileService)
    {

        if($service->getImage())
            $uploadFileService->remove($service->getImage());

        $this->entityManager->remove($service);
        $this->entityManager->flush();

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