<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class CoreController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        if($this->isGranted('ROLE_ADMIN'))
        {
            return $this->redirectToRoute('dashboard-admin');
        }
        else
        {
            return $this->redirectToRoute('dashboard-user',['id' => $this->getUser()->getId()]);
        }
        
    }

    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('core/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    #[Route('/logout', name: 'logout', methods: ['GET'])]
    public function logout()
    {
        // controller can be blank: it will never be called!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
