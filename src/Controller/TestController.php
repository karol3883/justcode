<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
