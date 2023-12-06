<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(Request $request,AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $errorMessage = null;

        if ($request->getMethod() === 'POST') {
            $email = $request->request->get('email');
            $password = $request->request->get('password');

            if (empty($email) || empty($password)) {
                $errorMessage = 'Veuillez fournir une adresse e-mail et un mot de passe valides.';
            }
        }


        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'errorMessage' => $errorMessage,
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        //throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}