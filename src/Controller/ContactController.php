<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use App\Entity\Contacttt;
class ContactController extends AbstractController
{
    /**
     * @Route("/student", name="app_student")
     */
    public function index(Request $request)
 {
 $smartphone = new Contacttt();
 $form = $this->createForm(ContactType::class, $smartphone);$form->handleRequest($request);
 if ($form->isSubmitted() && $form->isValid()) {
 // $form->getData() holds the submitted values
 // but, the original `$student` variable has also been updated
  $smartphone = $form->getData();
 // saving the task to the database
  $entityManager = $this->getDoctrine()->getManager();
  $entityManager->persist($smartphone);
  $entityManager->flush();
  //hedhi  thezik ll page o5ra confirm edhyka il etiquette
  //return $this->redirectToRoute('confirm');
  }
 return $this->render('contact/index.html.twig', ['form' => $form->createView(),]);
  }
 } 

















