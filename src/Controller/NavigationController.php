<?php

namespace App\Controller;

use App\Service\Navgiation\NavigationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavigationController extends AbstractController
{
//    #[Route('/contact', name: 'app_navigation_index')]
    public function index(string $pathInfo, NavigationServiceInterface $navigationService, Request $request): Response
    {
        return $this->render(
            'navigation/index.html.twig',
            [
                'navigation_elements' => iterator_to_array($navigationService->generateNavigation($pathInfo, $request->getLocale())),
            ]
        );
    }
}
