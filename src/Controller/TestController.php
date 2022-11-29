<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TodoController',
        ]);
    }


    #[Route('/timeline', name: 'app_timeline')]
    public function timeline(): Response
    {
        return $this->render('test/timeline.html.twig', [
            'controller_name' => 'TodoController',
        ]);
    }

    #[Route('/accordion', name: 'app_accordion')]
    public function accordion(): Response
    {
        return $this->render('test/accordion.html.twig', [
            'controller_name' => 'TodoController',
            'accordion_data' => $this->getAccordionData(),
        ]);
    }

    #[Route('/all_routes', name: 'app_all_routes')]
    public function allRoutes(RouterInterface $router): Response
    {
//        dd($router->getRouteCollection()->all());
        return $this->render('test/all_routes.html.twig', [
            'controller_name' => 'TodoController',
            'routes' => $router->getRouteCollection()->all(),
        ]);
    }

    public function test(Session $session): Response
    {

        dd($session->getFlashBag());
//        dd(123);
        return $this->render('partials/messages.html.twig', [
            'controller_name' => 'TodoController',
        ]);
    }

    private function convertController(\Symfony\Component\Routing\Route $route)
    {
        $nameParser = $this->get('controller_name_converter');
        if ($route->hasDefault('_controller')) {
            try {
                $route->setDefault('_controller', $nameParser->build($route->getDefault('_controller')));
            } catch (\InvalidArgumentException $e) {
            }
        }
    }

    private function getAccordionData(): array
    {

        return [
            [
                'title' => 'Backend',
                'description' => 'Short desc',
                'skills' => [
                    'PHP',
                    'Laravel',
                    'Symfony',
                ]
            ],
            [
                'title' => 'Frontend',
                'description' => 'Short desc',
                'skills' => [
                    'vanilla',
                    'vue',
                    'react',
                ]
            ],
            [
                'title' => 'Database',
                'description' => 'Short desc',
                'skills' => [
                    'MySQl',
                    'PostgreSql',
                    'PL/SQL',
                ]
            ],
        ];
    }
}
