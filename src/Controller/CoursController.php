<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Bundle\FixturesBundle\Fixture;

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
            $newFilename = $originalFilename.'-'.uniqid().'.'.$photo_prod->getClientOriginalExtension();
            $photo_prod->move($this->getParameter('images_directory'),$newFilename);
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
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $coursRepository->add($cour, true);

            return $this->redirectToRoute('app_cours_index', [], Response::HTTP_SEE_OTHER);
        }

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
        if ($this->isCsrfTokenValid('delete'.$cour->getId(), $request->request->get('_token'))) {
            $coursRepository->remove($cour, true);
        }

        return $this->redirectToRoute('app_cours_index', [], Response::HTTP_SEE_OTHER);
    }
     /**
 * @Route("/setimage", name="app_setimage")
 */
/*public function showimg(CoursRepository $coursRepository)
{
    $publicImagePath = $this->getParameter('kernel.project_dir') . '/public/images/';

    $finder1 = new Finder();
    $finder1->files()->in($publicImagePath);

    $entityManager = $this->getDoctrine()->getManager();

    foreach ($finder1 as $file) {
        $imageName = $file->getFilename();

        // Vérifiez si l'image existe déjà dans la base de données
        $existingCours = $coursRepository->findOneBy(['image' => $imageName]);

        if (!$existingCours) {
            // Si l'image n'existe pas, créez une nouvelle entité Cours et enregistrez le nom de l'image
            $cours = new Cours();
            $cours->setImage($imageName);

            $entityManager->persist($cours);
        }
    }

    // Exécutez les opérations de base de données
    $entityManager->flush();

    // Récupérez tous les cours après l'ajout des images
    $cours = $coursRepository->findAll();

    return $this->render('setimage/index.html.twig', [
        'controller_name' => 'SetimageController',
        'imageNames' => $imageName,
    ]);*/
}
