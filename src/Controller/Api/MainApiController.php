<?php


namespace App\Controller\Api;


use App\Entity\Mail;
use App\Repository\LocaleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Swift_Mailer;
use Swift_Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class MainApiController extends AbstractController
{
    public function getLanguages(LocaleRepository $localeRepository)
    {
        return new JsonResponse($localeRepository->getAllLanguages());
    }

    public function sendMail(Request $request, Swift_Mailer $mailer, EntityManagerInterface $entityManager)
    {
        $mail = $request->get('mail');
        $phone = $request->get('phone');
        $name = $request->get('name');
        $message = $request->get('message');

        $mail_ent = new Mail();
        $mail_ent->setMail($mail)
            ->setPhone($phone)
            ->setName($name)
            ->setMessage($message);

        $entityManager->persist($mail_ent);
        $entityManager->flush();



        if($mail){
            $message = (new Swift_Message('Hello Email'))
                ->setFrom('zhenya1995q@gmail.com')
                ->setTo('zhenya1995q@gmail.com')
                ->setBody($this->renderView('mail.html.twig', ['mail' => $mail, 'phone' => $phone, 'name' => $name, 'message' => $message]), 'text/html');
            $mailer->send($message);
        }
        return new JsonResponse(null, 200);
    }

}