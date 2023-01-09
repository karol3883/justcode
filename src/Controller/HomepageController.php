<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name:'app_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('homepage/index.html.twig', [
           'controller_name' =>'HomepageController',
            'accordion_data' => $this->getAccordionData(),
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


    #[Route('/oferta', name:'app_offer_2')]
    public function offer2(): Response
    {
        return $this->render('homepage/offer2.html.twig', [
            'using_technologies' => $this->getUsedTechnologies(),
        ]);
    }

    private function getUsedTechnologies()
    {
        return [
            [
                'name' => 'PHP',
                'description' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                Ipsam cumque recusandae dolorum porro, quasi sunt
                                                necessitatibus dolorem ab laudantium vel.'
            ],
            [
                'name' => 'SQL',
                'description' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                Ipsam cumque recusandae dolorum porro, quasi sunt
                                                necessitatibus dolorem ab laudantium vel.'
            ],
            [
                'name' => 'Docker',
                'description' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                Ipsam cumque recusandae dolorum porro, quasi sunt
                                                necessitatibus dolorem ab laudantium vel.'
            ],
            [
                'name' => 'GitLab',
                'description' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                Ipsam cumque recusandae dolorum porro, quasi sunt
                                                necessitatibus dolorem ab laudantium vel.'
            ],
        ];
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
                'description' => 'Tworzac frontend wykorzystuję wszelakiego rodzaju technologie',
                'skills' => [
                    'Vanilla.js',
                    'Vue.js',
                    'React.js',
                    'Bootstarp',
                    'Tailwind',
                ]
            ],
            [
                'title' => 'Bazy danych',
                'description' => 'Pracuję w oparciu o różne silniki bazodanowe',
                'skills' => [
                    'MySQl',
                    'PostgreSql',
                    'PL/SQL',
                ]
            ],
        ];
    }
}
