<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\Validator\ValidatorInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {
        return $this->render('contact/index.html.twig',
            [
                'controller_name' => 'ContactController',
            ]
        );
    }

    #[Route('/sendEmail', name: 'app_contact_send_email', methods: ['POST'])]
//    public function sendEmail(MailerInterface $mailer): Response
    public function sendEmail(Request $request, ValidatorInterface $validator): Response
    {
        $input = $request->request->all();
        if (!$validator->isValid(['email', 'name', 'message'], $input)) {
            return $this->redirect('contact');
        }

        $this->addFlash('success', 'Email został wysłany poprawnie!');

        return $this->redirectToRoute('app_index');

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
    }
}
