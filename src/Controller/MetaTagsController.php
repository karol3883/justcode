<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MetaTagsController extends AbstractController
{
    public function index(string $path_info, Request $request): Response
    {
        return $this->render('meta_tags/index.html.twig',
            [
                'meta_description' => $this->generateMetaDescription()[$path_info] ?? 'Programowanie w języku PHP - Karol Abramczyk',
            ]
        );
    }

    private function generateMetaDescription()
    {
        return [
            '/' => 'Programowanie w języku PHP, Symfony, Laravel oraz Javascript - vanilla.js, Vue.js, React.js',
            '/contact' => 'Chcesz się z nami skontaktować? Napisz na contact@justcode.com.pl'
        ];
    }
}
