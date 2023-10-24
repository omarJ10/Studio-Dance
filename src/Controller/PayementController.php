<?php

namespace App\Controller;

use App\Form\ClientType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Client;
use Symfony\Component\HttpFoundation\Request;

class PayementController extends AbstractController
{
    /**
     * @Route("/payement", name="app_payement")
     */
    public function index(): Response
    {
        return $this->render('payement/index.html.twig', [
            'controller_name' => 'PayementController',
        ]);
        // src/Controller/ClientController.php
    }


    /**
     * @Route("/client/payer", name="client_payer")
     */
    public function payerAction(Request $request)
    {
        $client = new Client();

        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $client->setPaiement(1);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            // Rediriger ou effectuer d'autres actions après le paiement réussi.
        }

        return $this->render('payement/payer.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
