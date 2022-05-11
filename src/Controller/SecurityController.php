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
     * @Route("/login", name="login")
     */
    public function loginAction(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

//        $hash = '$2y$10$7idhJNy0Hn0hczxc2TPhWer5jKlk0/u7uRBrvV4mYO1NotngaS.BG';
//                 '$2y$10$uKHh0Q.OK3KbPm47chaSnOQaqEEfhViuqrj4SflLi/L1j6GwAyDje'


//        var_dump(password_hash('123456789@a', PASSWORD_DEFAULT));
        
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheck(): void
    {
        // This code is never executed.
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutCheck(): void
    {
        // This code is never executed.
    }
}
