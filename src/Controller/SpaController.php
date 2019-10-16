<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SpaController extends AbstractController
{

    /**
     * @Route(path="/{spa_route}", name="spa", requirements={ "spa_route" = "^(?!.*(api.*|admin.*)$).*" })
     *
     * @return Response
     */

    public function index()
    {
        return $this->render('spa.html.twig');
    }
}
