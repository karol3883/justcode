<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Validator\Constraints;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

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
    public function sendEmail(Request $request, RouterInterface $router): Response
    {
        $input = $request->request->all();
        $validator = Validation::createValidator();
        $constraint = new Constraints\Collection([
            'email' => [
                new Constraints\Email(['message' => 'Email jest nieporpawny']),
                new Constraints\Length(['min' => 5, 'max' => 100]),
            ],
            'name' => [
                new Constraints\Regex('/[a-z]/i', 'Bład - imie może zawierać tylko litery'),
                new Constraints\Length(
                    [
                        'min' => 3,
                        'max' => 100,
                        'minMessage' => 'Imię - wpisz minimum 3 znaki!'
                    ]
                )
            ],
            'message' => new Constraints\Length(['min' => 10, 'max' => 500]),
        ]);

        $violations = $validator->validate($input, $constraint);

        if (count($violations) !== 0) {
            foreach($violations as $violation) {
//                $this->addFlash('danger', "{$violation->getPropertyPath()}: {$violation->getMessage()}");
                $this->addFlash('danger', "{$violation->getMessage()}");
            }

            return $this->redirect('contact');
        }

        $this->addFlash('success', 'Poprawnie wysłano email');
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
