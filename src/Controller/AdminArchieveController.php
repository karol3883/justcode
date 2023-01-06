<?php

namespace App\Controller;

use League\Flysystem\FilesystemOperator;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/archieve', name: 'app_todo')]
class AdminArchieveController extends AbstractController
{

    public function __construct(
//        private FilesystemOperator $defaultStorage
//        private FilesystemOperator $cdnStorage
    )
    {
//        $this->defaultStorage = $this->cdnStorage;
    }

    #[Route('/logs', name: 'app_admin_archieve_index')]
    public function index(): Response
    {
        $stream = fopen('../var/log/dev.log', 'r+');
        try {

//            $this->cdnStorage->writeStream('/var/log',$stream);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
//        $this->defaultStorage->move('/var/log/dev/log','/dupa');
//        $this->defaultStorage->up

        dd("Logs has been archieved!");
        return $this->render('todo/index.html.twig', [
            'controller_name' => 'TodoController',
        ]);
    }

}
