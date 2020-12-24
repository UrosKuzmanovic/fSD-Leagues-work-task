<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/utakmica")
 */
class UtakmicaController extends AbstractController
{
    private $utakmice;

    /**
     * @Route("/lista", name="lista_utakmica", methods={"GET"})
     */
    public function getListaUtakmica(): Response
    {
        return $this->render(
            'utakmica/listaUtakmica.html.twig', [
            'controller_name' => 'UtakmicaController',
            'utakmice' => $this->utakmice
        ]);
    }

    /**
     * @Route("/unesi", name="unesi_utakmicu", methods={"GET"})
     */
    public function getUnesiUtakmicu(): Response
    {
        return $this->render(
            'utakmica/unesiUtakmicu.html.twig', [
            'controller_name' => 'UtakmicaController',
        ]);
    }
}
