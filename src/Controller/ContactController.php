<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        return $this->render('contact/index.html.twig',
            [
                'controller_name' => 'ContactController',
            ]
        );
    }


//    #[Route('/sendEmail', name: 'app_contact_send_email', methods: ['POST'])]
//    public function sendEmail(Request $request): Response
//    {
//        dd($request->request->all());
//        return $this->render('contact/index.html.twig', [
//            'controller_name' => 'ContactController',
//        ]);
//    }

    #[Route('/sendEmail', name: 'app_contact_send_email', methods: ['POST'])]
//    public function sendEmail(MailerInterface $mailer): Response
    public function sendEmail(): Response
    {
        echo 'NIMA NIC';
        die;
        $email = (new Email())
            ->from('karol3883@karol3883.smallhost.pl')
            ->to('karol3883@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Test heroku symfony mail')
            ->text('Test heroku symfony mail!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);

        dd(1234);
        // ...
    }
}
