<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class MailerController extends AbstractController
{
    // NOT WORKING YET
    #[Route('/mail/send', name: 'mail-send')]
    public function send(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('jeffrey.landreau@livecampus.tech')
            ->to('jeffrey.landreau@livecampus.tech')
            ->subject('Inscription IdeAll')
            ->text('Test')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);
        //dd($email);

        return $this->render('mailer/index.html.twig', [
            'controller_name' => 'MailerController',
        ]);
    }
}
