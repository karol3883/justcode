<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'app_todo')]
class AdminController extends AbstractController
{
//    public function __construct(LoggerInterface $logger)
//    {
////        $logger->warning('Test');
//    }

    #[Route('', name: 'app_admin_index')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'TodoController',
        ]);
    }


    #[Route('/todo/create', name: 'app_todo_create')]
    public function createTodo(): Response
    {
        return $this->render(
            'todo/create.html.twig',
            [
                'controller_name' => 'CreateTodo',
            ]
        );
    }

}
