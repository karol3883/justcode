<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name:'app_index')]
    public function index(): Response
    {
        return $this->render('homepage/index.html.twig', [
           'controller_name' =>'HomepageController',
        ]);
    }


    public function test(): Response
    {
        return $this->render('homepage/index.html.twig', [
        ]);
    }

    #[Route('/homepage', name:'app_homepage')]
    public function homepage(Request $request): Response
    {
        return $this->render('homepage/index.html.twig', [
        ]);
    }


    #[Route('/oferta', name:'app_offer')]
    public function offer(): Response
    {
        return $this->render('homepage/offer.html.twig');
    }
}
