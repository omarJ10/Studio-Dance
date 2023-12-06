<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HhController extends AbstractController
{
    /**
     * @Route("/hh", name="app_hh")
     */
    public function index(): Response
    {
        return $this->render('hh/index.html.twig', [
            'controller_name' => 'HhController',
        ]);
    }
}
