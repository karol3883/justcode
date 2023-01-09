<?php

namespace App\Homepage\UI\Web;

use Britenet\EOL\Employee\Domain\Employee;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomepageController extends AbstractController
{

    /**
     *
     * @return Response
     */
    #[Route(path: '/homepage', name: 'homepage', methods: [Request::METHOD_GET])]
    final public function homepage(): Response
    {
        echo 1234;
        die;
    }
}