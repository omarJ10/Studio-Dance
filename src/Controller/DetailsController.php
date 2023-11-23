<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cours;
use App\Entity\Coach;


class DetailsController extends AbstractController
{
    /**
     * @Route("/details/{id}", name="app_details")

    /**
     * @Route("/details/{id}", name="app_details", methods={"GET"})

     */
    public function index(Cours $cour): Response
    {
        return $this->render('details/index.html.twig', [
            'cour' => $cour,
        ]);
    }

/**
 * @Route("/coach_details/{id}", name="app_coach_detail", methods={"GET"})
 */

 public function coach(Cours $cour): Response
{
    $coach = $cour->getCoach(); // Assurez-vous que votre entité Cours a une méthode getCoach().

    return $this->render('details/Coach.html.twig', [
        'coach' => $coach,
    ]);
}

}
