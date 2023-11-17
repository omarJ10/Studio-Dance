<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Form\Offre1Type;
use App\Repository\OffreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/offre1")
 */
class Offre1Controller extends AbstractController
{
    /**
     * @Route("/", name="app_offre1_index", methods={"GET"})
     */
    public function index(OffreRepository $offreRepository): Response
    {
        return $this->render('offre1/index.html.twig', [
            'offres' => $offreRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_offre1_new", methods={"GET", "POST"})
     */
    public function new(Request $request, OffreRepository $offreRepository): Response
    {
        $offre = new Offre();
        $form = $this->createForm(Offre1Type::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offreRepository->add($offre, true);

            return $this->redirectToRoute('app_offre1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('offre1/new.html.twig', [
            'offre' => $offre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_offre1_show", methods={"GET"})
     */
    public function show(Offre $offre): Response
    {
        return $this->render('offre1/show.html.twig', [
            'offre' => $offre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_offre1_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Offre $offre, OffreRepository $offreRepository): Response
    {
        $form = $this->createForm(Offre1Type::class, $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $offreRepository->add($offre, true);

            return $this->redirectToRoute('app_offre1_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('offre1/edit.html.twig', [
            'offre' => $offre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_offre1_delete", methods={"POST"})
     */
    public function delete(Request $request, Offre $offre, OffreRepository $offreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offre->getId(), $request->request->get('_token'))) {
            $offreRepository->remove($offre, true);
        }

        return $this->redirectToRoute('app_offre1_index', [], Response::HTTP_SEE_OTHER);
    }
}
