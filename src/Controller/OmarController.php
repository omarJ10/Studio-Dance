<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
