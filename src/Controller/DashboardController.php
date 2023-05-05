<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dashboard')]
class DashboardController extends AbstractController
{
    #[Route('/admin', name: 'dashboard-admin'),IsGranted('ROLE_ADMIN')]
    public function admin(): Response
    {
        return $this->render('dashboard/admin.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/user/{id}', name: 'dashboard-user')]
    public function user(): Response
    {
        return $this->render('dashboard/user.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}
