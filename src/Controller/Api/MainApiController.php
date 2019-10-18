<?php


namespace App\Controller\Api;


use App\Repository\LocaleRepository;
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

    public function sendMail(Request $request, Swift_Mailer $mailer)
    {
        $mail = $request->get('mail');
        $phone = $request->get('phone');
        $name = $request->get('name');
        $message = $request->get('message');
        if($mail){
            $message = (new Swift_Message('Hello Email'))
                ->setFrom('zhenya1995q@gmail.com')
                ->setTo('zhenya1995q@gmail.com')
                ->setBody($this->renderView('mail.html.twig', ['mail' => $mail, 'phone' => $phone, 'name' => $name, 'message' => $message]), 'text/html');

            $mailer->send($message);
        }
        return new JsonResponse([$mail, $phone, $name, $message]);
    }

}