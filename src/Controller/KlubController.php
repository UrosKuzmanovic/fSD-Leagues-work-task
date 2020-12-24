<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/klub")
 */
class KlubController extends AbstractController
{
    private $klubovi;

    /**
     * @Route("/lista", name="lista_klubova", methods={"GET"})
     */
    public function getListaKlubova(): Response
    {
        return $this->render(
            'klub/listaKlubova.html.twig', [
            'controller_name' => 'KlubController',
            'klubovi' => $this->klubovi
        ]);
    }

    /**
     * @Route("/unesi", name="unesi_klub", methods={"GET"})
     */
    public function getUnesiKlub(): Response
    {
        return $this->render(
            'klub/unesiKlub.html.twig', [
            'controller_name' => 'KlubController',
        ]);
    }
}
