<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CourDetailsController extends AbstractController
{
    /**
     * @Route("/cour/details", name="app_cour_details")
     */
    public function index(): Response
    {
        return $this->render('cour_details/index.html.twig', [
            'controller_name' => 'CourDetailsController',
        ]);
    }
}
