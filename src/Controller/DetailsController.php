<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cours;

class DetailsController extends AbstractController
{
    #[Route('/details/{id}', name: 'app_details', methods: ['GET'])]
    public function index(Cours $cour): Response
    {
        return $this->render('details/index.html.twig', [
            'cour' => $cour,
        ]);
    }
}
