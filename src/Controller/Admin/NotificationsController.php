<?php

namespace App\Controller\Admin;

use App\Repository\NotificationCounterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/notification', name: 'app_todo')]
class NotificationsController extends AbstractController
{

    #[Route('', name: 'app_admin_notification_index')]
    public function index(NotificationCounterRepository $notificationCounterRepository): Response
    {
        return $this->render('admin/notifications/index.html.twig',
            [
                'controller_name' => 'TodoController',
                'notification_counters' => $notificationCounterRepository->getNotificationsFromMonth(),
            ]
        );
    }

    #[Route('/id/{slug}', name: 'app_admin_notification_details')]
    public function notificationDetails(NotificationCounterRepository $notificationCounterRepository): Response
    {
        return $this->render('admin/notifications/index.html.twig',
            [
                'controller_name' => 'TodoController',
                'notification_counters' => $notificationCounterRepository->getNotificationsFromMonth(),
            ]
        );
    }


    #[Route('/create', name: 'app_admin_notification_create')]
    public function createNotification(): Response
    {
        return $this->render('admin/notifications/create.html.twig',
            [
                'controller_name' => 'TodoController',
            ]
        );
    }
    #[Route('/test', name: 'chuj')]
    public function chuj(): Response
    {
        return $this->render('admin/notifications/create.html.twig',
            [
                'controller_name' => 'TodoController',
            ]
        );
    }
}