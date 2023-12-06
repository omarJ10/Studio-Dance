<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ContactController extends AbstractController
{
/**
 * @Route("/contact", name="app_contact")
*/

    public function index(Request $request,Security $security): Response
    {
        $avis = new Avis();
        $form = $this->createForm(ContactType::class, $avis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avis->setDateHeure(new \DateTime());

            $client = $security->getUser();
            $avis->setClient($client);

            //$contact = $form->getData();
            // saving the task to the database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($avis);
            $entityManager->flush();
        }
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView(),
        ]);
    }

}