<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/igrac")
 */
class IgracController extends AbstractController
{
    /**
     * @Route("/lista", name="lista_igraca", methods={"GET"})
     */
    public function getListaIgraca(): Response
    {
        return $this->render('igrac/index.html.twig', [
            'controller_name' => 'IgracController',
        ]);
    }

    /**
     * @Route("/unesi", name="unesi_igraca", methods={"GET"})
     */
    public function getUnesiIgraca(): Response
    {
        return $this->render('igrac/index.html.twig', [
            'controller_name' => 'IgracController',
        ]);
    }
}
