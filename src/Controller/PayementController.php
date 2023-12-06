<?php

namespace App\Controller;

use App\Form\ClientType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Client;
use App\Entity\Cours;

use Symfony\Component\HttpFoundation\Request;

class PayementController extends AbstractController
{
    /**
     * @Route("/payement/{id}", name="app_payement")
     */
    public function index(Cours $cour): Response
    {
        return $this->render('payement/index.html.twig', [
            'controller_name' => 'PayementController',
            'cour' => $cour,
        ]);
    }

 

    /**
     * @Route("/payer/{id}", name="add_payer")
     */
// Your controller method
public function payerAction(Request $request, Cours $cour)
{
    $client = $this->getUser(); // Assuming your user information is stored in the Client entity


        $client->setPaiement(true);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($client);
        $entityManager->flush();

        // Rediriger ou effectuer d'autres actions après le paiement réussi.
    

    return $this->render('payement/index.html.twig', [
        'cour' => $cour,
    ]);
}
}

