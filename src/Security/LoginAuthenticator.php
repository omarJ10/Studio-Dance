<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Twig\Environment;


class LoginAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    private UrlGeneratorInterface $urlGenerator;
    private RouterInterface $router;
    private AuthenticationUtils $authenticationUtils;

    private Environment $twig;

    public function __construct(RouterInterface $router,UrlGeneratorInterface $urlGenerator, Environment $twig,AuthenticationUtils $authenticationUtils)
    {
        $this->urlGenerator = $urlGenerator;
        $this->router = $router;
        $this->authenticationUtils = $authenticationUtils;
        $this->twig = $twig;
    }

    public function authenticate(Request $request): Passport
    {
        $email = $request->request->get('email', '');

        $request->getSession()->set(Security::LAST_USERNAME, $email);

        return new Passport(
            new UserBadge($email),
            new PasswordCredentials($request->request->get('password', '')),
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        /*if ($targetPath = $this->getTargetPath($request->getSession(), $firewallName)) {
            return new RedirectResponse($targetPath);
        }*/

        $role = $token->getUser()->getRoles();
        if(in_array('ROLE_ADMIN',$role)){
            return new RedirectResponse($this->router->generate('app_interface_admin'));
        } else {
            return new RedirectResponse($this->router->generate('app_index'));
        }

        //return new RedirectResponse($this->urlGenerator->generate('app_index'));

    }
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): RedirectResponse
    {
        // Votre logique personnalisée pour gérer les erreurs d'authentification
        $errorMessage = $this->getAuthenticationErrorMessage($exception);

        // Stockez le message d'erreur dans la session pour l'afficher dans le contrôleur
        $request->getSession()->getFlashBag()->add('error', $errorMessage);

        // Redirigez vers la page de connexion
        return new RedirectResponse($this->urlGenerator->generate(self::LOGIN_ROUTE));
    }

    private function getAuthenticationErrorMessage(AuthenticationException $exception): string
    {
        $message = 'Invalid credentials.';

        // Vérifiez le message d'erreur spécifique et personnalisez la réponse
        if ($exception->getMessageKey() === 'Bad credentials') {
            $message = 'Wrong email or password.';
        } elseif ($exception->getMessageKey() === 'Email could not be found.') {
            $message = 'Wrong email.';
        }

        return $message;
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
