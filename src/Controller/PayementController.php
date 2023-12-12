<?php

namespace App\Controller;

use App\Form\ClientType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Client;
use App\Entity\Cours;
use App\Entity\Reservation ;

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

        $existingReservation = $this->getDoctrine()->getRepository(Reservation::class)
        ->findOneBy(['client' => $client, 'cours' => $cour]);

    if ($existingReservation) {
        // Le cours est déjà réservé par le client, afficher un message ou rediriger
        $this->addFlash('error', 'Vous avez déjà réservé ce cours.');

    }
    else{


        $reservation=new Reservation();
        $reservation->setClient($client);
        $reservation->setCours($cour);
        $reservation->setPaiement(true);
        $reservation->setDate(new \DateTime());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($reservation);
        $entityManager->flush();
    }

        // Rediriger ou effectuer d'autres actions après le paiement réussi.
    

    return $this->render('payement/index.html.twig', [
        'cour' => $cour,
    ]);

}
}

