<?php

namespace App\Controller;

use App\Entity\Cours;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\CoursRepository;  // Assurez-vous que vous utilisez la classe CoursRepository

class CourController extends AbstractController
{
    /**
     * @Route("/cour", name="app_cour")
     */
    public function index(CoursRepository $coursRepository): Response
    {
        return $this->render('cour/index.html.twig', [
            'cours' => $coursRepository->findAll(),
        ]);
    }



}
