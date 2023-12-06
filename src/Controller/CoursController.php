<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; 

/**
 * @Route("/cours")
 */
class CoursController extends AbstractController
{
    /**
     * @Route("/", name="app_cours_index", methods={"GET"})
     */
    public function index(CoursRepository $coursRepository): Response
    {
        return $this->render('cours/index.html.twig', [
            'cours' => $coursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_cours_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CoursRepository $coursRepository): Response
    {
        $cour = new Cours();
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $cour = $form->getData();
            //**************** Manage Uploaded FileName
            $photo_prod = $form->get('image')->getData();
            $originalFilename = $photo_prod->getClientOriginalName();
            $newFilename = $originalFilename . '-' . uniqid() . '.' . $photo_prod->getClientOriginalExtension();
            $photo_prod->move($this->getParameter('images_directory'), $newFilename);
            $cour->setImage($newFilename);
            //****************

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cour);
            $entityManager->flush();

            $coursRepository->add($cour, true);
            return $this->redirectToRoute('app_cours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cours/new.html.twig', [
            'cour' => $cour,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_cours_show", methods={"GET"})
     */
    public function show(Cours $cour): Response
    {
        return $this->render('cours/show.html.twig', [
            'cour' => $cour,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_cours_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Cours $cour, CoursRepository $coursRepository): Response
    {
        // Store the current image file name
        $currentImage = $cour->getImage();
        // Create the form
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);
        // Check if the form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {
            // Get the file from the form
            $file = $form->get('image')->getData();

            // Check if a new file is uploaded
            if ($file) {
                // Generate a unique name for the file
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                // Move the file to the desired directory
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
                // Remove the old image file if it exists
                $oldImagePath = $this->getParameter('images_directory') . '/' . $currentImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
                // Update the image property of the cours entity with the new file name
                $cour->setImage($fileName);
            }

            // Save the changes to the database
            $coursRepository->add($cour, true);
            // Redirect to the cours index page
            return $this->redirectToRoute('app_cours_index', [], Response::HTTP_SEE_OTHER);
        }

        // Render the edit form template
        return $this->renderForm('cours/edit.html.twig', [
            'cour' => $cour,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}", name="app_cours_delete", methods={"POST"})
     */
    public function delete(Request $request, Cours $cour, CoursRepository $coursRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $cour->getId(), $request->request->get('_token'))) {
            $coursRepository->remove($cour, true);
        }

        return $this->redirectToRoute('app_cours_index', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route("/setimage", name="app_setimage")
     */


    /**
     * @Route("/get-cours", name="get_cours", methods={"GET"})
     */
    public function getCours(CoursRepository $coursRepository): JsonResponse
    {
        $cours = $coursRepository->findAll(); // Adjust this based on your entity and repository

        $formattedCours = [];
        foreach ($cours as $c) {
            $formattedCours[] = [
                'title' => $c->getTitle(),  // Replace with the property of your Cours entity representing the title
                'start' => $c->getStartDate()->format('Y-m-d H:i:s'),  // Replace with the property representing the start date
                'end' => $c->getEndDate()->format('Y-m-d H:i:s'),  // Replace with the property representing the end date
            ];
        }

        return new JsonResponse($formattedCours);
    }


}
