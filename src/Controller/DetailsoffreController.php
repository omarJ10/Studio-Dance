<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Offre;  


class DetailsoffreController extends AbstractController
{
    #[Route('/detailsoffre/{id}', name: 'app_detailsoffre')]
    public function index(Offre $offre ): Response
    {
        return $this->render('detailsoffre/index.html.twig', [

         'offre' => $offre,      ]);
    }

}
