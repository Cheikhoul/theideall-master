<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/user')]
class UserController extends AbstractController
{

    #[Route('/add', name: 'user-add'),IsGranted('ROLE_ADMIN')]
    public function new(UserPasswordHasherInterface $passwordHasher, Request $request,ManagerRegistry $doctrine): Response
    {
        
        $user = new User();

        $form = $this->createForm(UserType::class , $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($passwordHasher->hashPassword($user,$user->getPassword()));
            $user->setStatus(true);
            $user->setRoles(array($form->get('roles')->getData()));
            //dd($form->get('roles')->getData());
            $doctrine->getManager()->persist($user);
            $doctrine->getManager()->flush();
            return $this->redirectToRoute('user-list');
        }

        return $this->renderForm('user/add.html.twig', [
            'form' => $form
        ]);
    }
    #[Route('/list', name: 'user-list' ),IsGranted('ROLE_ADMIN')]
    public function list(ManagerRegistry $doctrine): Response
    {
        $users = $doctrine->getRepository(User::class)->findAll();

        return $this->render('user/list.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/my-profile/info', name: 'user-profile-info')]
    public function profileInfo(): Response
    {
        $user = $this->getUser();
        return $this->render('user/profile-info.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/my-profile/invoice', name: 'user-profile-invoice')]
    public function profileInvoice(): Response
    {
        $user = $this->getUser();
        return $this->render('user/profile-invoice.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/detail/{id}', name: 'user-detail')]
    public function detail(): Response
    {
        return $this->render('user/detail.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/delete/{id}', name: 'user-delete')]
    public function delete(): Response
    {
        return $this->redirectToRoute('user-list');
    }

    #[Route('/edit', name: 'user-edit')]
    public function edit(UserPasswordHasherInterface $passwordHasher,ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        if(filter_input(INPUT_POST,'_email') !== "")
        {
            $user->setEmail(filter_input(INPUT_POST,'_email'));
        }
        if(filter_input(INPUT_POST,'_phoneNumber') !== "")
        {
            $user->setPhonenumber(filter_input(INPUT_POST,'_phoneNumber'));
        }
        if(filter_input(INPUT_POST,'_address') !== "")
        {
            $user->setAddress(filter_input(INPUT_POST,'_address'));
        }
        if($passwordHasher->isPasswordValid($user, filter_input(INPUT_POST,'_oldPassword')) && (filter_input(INPUT_POST,'_newPassword') == filter_input(INPUT_POST,'_confirmNewPassword')))
        {
            $user->setPassword($passwordHasher->hashPassword($user,filter_input(INPUT_POST,'_newPassword')));
        }
        $doctrine->getManager()->persist($user);
        $doctrine->getManager()->flush();
        return $this->redirectToRoute('user-profile-info');
    }

}
