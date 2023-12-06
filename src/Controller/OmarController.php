<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;

class OmarController extends AbstractController
{
    /**
     * @Route("/courDetails", name="app_cour_details")
     */
    public function index(): Response
    {
        return $this->render('omar/index.html.twig', [
            'controller_name' => 'OmarController',
        ]);
    }
    /**
     * @Route("/cour_detail/{id}", name="app_cour_detail", methods={"GET"})
     */
    public function show(Cours $cour): Response
    {
        return $this->render('omar/index.html.twig', [
            'cour' => $cour,
        ]);
    }
}
