<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mesto")
 */
class MestoController extends AbstractController
{
    /**
     * @Route("/lista", name="lista_mesta", methods={"GET"})
     */
    public function getListaMesta(): Response
    {
        return $this->render('mesto/index.html.twig', [
            'controller_name' => 'MestoController',
        ]);
    }

    /**
     * @Route("/unesi", name="unesi_mesto", methods={"GET"})
     */
    public function getMestoIgraca(): Response
    {
        return $this->render('mesto/index.html.twig', [
            'controller_name' => 'MestoController',
        ]);
    }
}
