<?php


namespace App\Controller\Admin;


use App\DTO\CreateServiceDTO;
use App\DTO\EditServiceDTO;
use App\Entity\Service;
use App\Entity\ServiceTranslation;
use App\Form\CreateServiceForm;
use App\Form\EditServiceForm;
use App\Mapper\ServiceMapper;
use App\Repository\LocaleRepository;
use App\Repository\ServiceRepository;
use App\Service\UploadFile\UploadFileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

class ServiceController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;


    /**
     * ServiceController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
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
            $service->setPrice($data->getPrice());

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
            $id->setPrice($data->getPrice());
            if($data->getImage()){
                $image = $uploadFileService->upload($data->getImage());
                $id->setImage($image);
            }
            $this->entityManager->persist($id);
            $this->entityManager->flush();

            return $this->redirectToRoute('service_main');
        }

        return $this->render('admin/service/edit_service.html.twig', ['form' => $form->createView(), 'image' => $id->getImage()]);
    }
}