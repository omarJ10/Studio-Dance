<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CourDetailController extends AbstractController
{
    /**
     * @Route("/cour_detail", name="app_cour_detail")
     */
    public function index(): Response
    {
        return $this->render('cour_detail/index.html.twig', [
            'controller_name' => 'CourDetailController',
        ]);
    }
}
