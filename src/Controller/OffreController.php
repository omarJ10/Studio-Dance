<?php

namespace App\Controller;

use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffreController extends AbstractController
{
    /**
     * @Route("/schual", name="app_offre")
     */
    public function index(CoursRepository $coursRepository): Response
    {
        return $this->render('offre/index.html.twig', [
            'controller_name' => 'OffreController',
            'cours' => $coursRepository->findAll(),
        ]);
    }
    //function get courses
}
