<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Activity;
use App\Form\ActivityType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

#[Route('/activity')]
class ActivityController extends AbstractController
{

    #[Route('/add', name: 'activity-add')]
    public function add(Request $request,ManagerRegistry $doctrine): Response
    {
        $activity = new Activity();

        $form = $this->createForm(ActivityType::class , $activity);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine->getManager()->persist($activity);
            $doctrine->getManager()->flush();
            return $this->redirectToRoute('activity-add');
        }

        return $this->renderForm('activity/add.html.twig', [
            'form' => $form
        ]);
    }

}
