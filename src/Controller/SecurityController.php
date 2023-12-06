<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
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

        if ($error instanceof AuthenticationException) {
            $errorMessage = $this->getAuthenticationErrorMessage($error);
        }

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'errorMessage' => $errorMessage,
        ]);
    }
    private function getAuthenticationErrorMessage(AuthenticationException $exception): string
    {
        $message = 'Invalid credentials.';

        // Check the specific error message and customize the response
        if ($exception->getMessageKey() === 'Bad credentials') {
            $message = 'Wrong email or password.';
        } elseif ($exception->getMessageKey() === 'Email could not be found.') {
            $message = 'Wrong email.';
        }

        return $message;
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        //throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
