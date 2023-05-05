<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Event;
use App\Form\EventType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Registration;
use App\Entity\User;

#[Route('/event')]
class EventController extends AbstractController
{
    #[Route('/list', name: 'event-list')]
    public function list(ManagerRegistry $doctrine): Response
    { 
        $events = $doctrine->getRepository(Event::class)->findAll();
        $eventAccepted = array();
        $user = $this->getUser();
        $eventPending = array();
        foreach ($events as $event) {
            $registrations = $event->getRegistrations();
            $usersAccepted = array();
            $usersPending = array();
        foreach ($registrations as $registration) {
            if($registration->getStatus() == 'accepted')
            {
                $usersAccepted[] = $registration->getUser();
            }   
            if($registration->getStatus() == 'pending')
            {
                $usersPending[] = $registration->getUser();
            }
        }
        $eventAccepted += [$event->getId() => count($usersAccepted)];
        $eventPending += [$event->getId() => (count($usersPending)>=1)];
        
    }
    
        return $this->render('event/list.html.twig', [
            'events' => $events,
            'eventAccepted' => $eventAccepted,
            'eventPending' => $eventPending,
            'user' => $user
            
        ]);
    }

    #[Route('/add', name: 'event-add')]
    public function add(Request $request,ManagerRegistry $doctrine): Response
    {
        $event = new Event();

        $form = $this->createForm(EventType::class , $event);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event->setActivity($form->get("activity")->getData());
            $doctrine->getManager()->persist($event);
            $doctrine->getManager()->flush();
            return $this->redirectToRoute('event-list');
        }

        return $this->renderForm('event/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/edit/{id}', name: 'event-edit')]
    public function edit(): Response
    {
        return $this->render('event/edit.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }

    #[Route('/registration/{id}/{user}', name: 'event-registration')]
    public function registration(string $id,string $user,ManagerRegistry $doctrine): Response
    {
        $registration = new Registration();
        
        $registration->setUser($doctrine->getRepository(User::class)->find($user));
        $registration->setEvent($doctrine->getRepository(Event::class)->find($id));
        $registration->setStatus("pending");
        $doctrine->getManager()->persist($registration);
        $doctrine->getManager()->flush();
        return $this->redirectToRoute('event-list');
    }

    #[Route('/validation/{id}/{user}', name: 'event-validation')]
    public function validation(string $id,string $user,ManagerRegistry $doctrine): Response
    {
        $registration = $doctrine->getRepository(Registration::class)->findOneBy(['user' => $user,'event' => $id]);
        $registration->setStatus("accepted");
        $doctrine->getManager()->persist($registration);
        $doctrine->getManager()->flush();
        return $this->redirectToRoute('event-detail', ['id' => $id]);
    }

    #[Route('/rejection/{id}/{user}', name: 'event-rejection')]
    public function rejection(string $id,string $user,ManagerRegistry $doctrine): Response
    {
        $registration = $doctrine->getRepository(Registration::class)->findOneBy(['user' => $user,'event' => $id]);
        $doctrine->getManager()->remove($registration);
        $doctrine->getManager()->flush();
        return $this->redirectToRoute('event-detail', ['id' => $id]);
    }

    #[Route('/delete/{id}', name: 'event-delete')]
    public function delete(string $id,ManagerRegistry $doctrine): Response
    {
        $event = $doctrine->getRepository(Event::class)->find($id);
        $doctrine->getManager()->remove($event);
        $doctrine->getManager()->flush();
        return $this->redirectToRoute('event-list');
    }

    #[Route('/detail/{id}', name: 'event-detail')]
    public function detail(string $id, ManagerRegistry $doctrine): Response
    {
        $event = $doctrine->getRepository(Event::class)->find($id);
        $registrations = $event->getRegistrations();
        $usersAccepted = array();
        $usersPending = array();
        $user = $this->getUser();
        foreach ($registrations as $registration) {
            if($registration->getStatus() == 'pending')
            {
                $usersPending[] = $registration->getUser();
            }
            if($registration->getStatus() == 'accepted')
            {
                $usersAccepted[] = $registration->getUser();
            }
        }
        
        return $this->render('event/detail.html.twig', [
            'event' => $event,
            'userAccepted' =>$usersAccepted,
            'userPending' =>$usersPending,
            'user' => $user
        ]);
    }
    
}
