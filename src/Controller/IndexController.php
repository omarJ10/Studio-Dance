<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CoursRepository; 
use App\Repository\OffreRepository; 
use App\Entity\Offre;
use App\Entity\Cours;

use App\Entity\Reservation;
class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="app_index")
     */
    public function index(OffreRepository $offreRepository,CoursRepository $coursRepository): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'offres' => $offreRepository->findAll(),
            'cours' => $coursRepository->findAll()

        ]);
    }

    /**
     * @Route("/book-offer/{id}", name="book_offer")
     */
    public function bookOffer(int $id): Response
    {
        dump("helllo".$id);

        $entityManager = $this->getDoctrine()->getManager();

        // Get the authenticated user (you need to have the security system set up)
        $user = $this->getUser();

        // Check if the user is authenticated
        if ($user) {
            // Find the offer by ID
            $offre = $entityManager->getRepository(Offre::class)->find($id);


            // Check if the offer exists
            if ($offre) {
                // Create a new Reservation entity
                $reservation = new Reservation();
                $reservation->setClient($user);
                $reservation->setOffre($offre);
                $reservation->setDate(new \DateTime());
               /* $email = (new Email())
                ->from('helasaoudi024@gmail.com')
                ->to($user->getEmail())
                ->subject('Confirmation de réservation')
                ->text('Votre réservation a été confirmée avec succès!');
    
            $mailer->send($email);*/

                // Persist and flush the reservation to the database
                $entityManager->persist($reservation);
                $entityManager->flush();

                // You can add a success flash message if needed
                $this->addFlash('success', 'Offer booked successfully.');
            } else {
                // Handle the case where the offer does not exist
                $this->addFlash('error', 'Offer not found.');
            }
        } else {
            // Handle the case where the user is not authenticated
            $this->addFlash('error', 'You need to be logged in to book an offer.');
        }

        // Redirect back to the offer details page
        return $this->redirectToRoute('app_detailsoffre', ['id' => $id]);
    }
     /**
     * @Route("/book-cour/{id}", name="book_cour")
     */
    public function bookCour(int $id): Response
    {
        // ...
    
        // Get the authenticated user (you need to have the security system set up)
        $user = $this->getUser();
    
        // Check if the user is authenticated
        if ($user) {
            // Find the offer by ID
            $cour = $entityManager->getRepository(Cours::class)->find($id);
    
            $existingReservation = $this->getDoctrine()->getRepository(Reservation::class)
                ->findOneBy(['client' => $user, 'cours' => $cour]);
    
            if ($existingReservation) {
                // Le cours est déjà réservé par le client, afficher un message ou rediriger
                $this->addFlash('error', 'Vous avez déjà réservé ce cours.');
            } else {
                // Check if the offer exists

                if ($cour) {
                    // Create a new Reservation entity
                    $reservation = new Reservation();
                    $reservation->setClient($user);
                    $reservation->setCours($cour);
                    $reservation->setDate(new \DateTime());
    
                    // Persist and flush the reservation to the database
                    $entityManager->persist($reservation);
                    $entityManager->flush();
    
                    // You can add a success flash message if needed
                    $this->addFlash('success', 'Offer booked successfully.');
                } else {
                    // Handle the case where the offer does not exist
                    $this->addFlash('error', 'Offer not found.');
                }
            }
        } else {
            // Handle the case where the user is not authenticated
            $this->addFlash('error', 'You need to be logged in to book an offer.');
        }
    
        // Redirect back to the offer details page
        return $this->redirectToRoute('app_details', ['id' => $id]);
    }
}