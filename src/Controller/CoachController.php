<?php

namespace App\Controller;

use App\Entity\Coach;
use App\Form\CoachType;
use App\Repository\CoachRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/coach")
 */
class CoachController extends AbstractController
{
    /**
     * @Route("/", name="app_coach_index", methods={"GET"})
     */
    public function index(CoachRepository $coachRepository): Response
    {

        return $this->render('coach/index.html.twig', [
            'coaches' => $coachRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_coach_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CoachRepository $coachRepository): Response
    {
        $coach = new Coach();
        $form = $this->createForm(CoachType::class, $coach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $coach = $form->getData();
            //**************** Manage Uploaded FileName
            $photo_prod = $form->get('image')->getData();
            $originalFilename = $photo_prod->getClientOriginalName();
            $newFilename = $originalFilename . '-' . uniqid() . '.' . $photo_prod->getClientOriginalExtension();
            $photo_prod->move($this->getParameter('images_directory'), $newFilename);
            $coach->setImage($newFilename);
            //****************

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($coach);
            $entityManager->flush();

            $coachRepository->add($coach,true);

            return $this->redirectToRoute('app_coach_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('coach/new.html.twig', [
            'coach' => $coach,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}", name="app_coach_show", methods={"GET"})
     */
    public function show(Coach $coach): Response
    {


        return $this->render('coach/show.html.twig', [
            'coach' => $coach,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_coach_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Coach $coach, CoachRepository $coachRepository): Response
    {
        $form = $this->createForm(CoachType::class, $coach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Handle file upload
            $file = $form['image']->getData();
            if ($file) {
                // Generate a unique name for the file
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();

                // Move the file to the desired directory
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );

                // Remove the old image file if it exists
                $oldImage = $this->getParameter('images_directory') . '/' . $coach->getImage();
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }

                // Update the image property of the Coach entity
                $coach->setImage($fileName);
            }

            // Save the Coach entity
            $coachRepository->add($coach, true);

            return $this->redirectToRoute('app_coach_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('coach/edit.html.twig', [
            'coach' => $coach,
            'form' => $form,
        ]);
    }



    /**
     * @Route("/{id}", name="app_coach_delete", methods={"POST"})
     */
    public function delete(Request $request, Coach $coach, CoachRepository $coachRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $coach->getId(), $request->request->get('_token'))) {
            $coachRepository->remove($coach, true);
        }

        return $this->redirectToRoute('app_coach_index', [], Response::HTTP_SEE_OTHER);
    }
}
