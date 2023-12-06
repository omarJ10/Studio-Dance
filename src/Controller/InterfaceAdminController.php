<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class InterfaceAdminController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/interface/admin", name="app_interface_admin")
     */
    public function index(): Response
    {
        return $this->render('interface_admin/index.html.twig', [
            'controller_name' => 'InterfaceAdminController',
        ]);
    }
}
