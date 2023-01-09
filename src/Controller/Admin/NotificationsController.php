<?php

namespace App\Controller\Admin;

use App\Entity\Notification;
use App\Entity\NotificationCounter;
use App\Repository\NotificationCounterRepository;
use App\Service\NotificationCounter\NotificationCounterServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/notification', name: 'app_todoapp')]
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


    #[Route('/create', name: '_admin_notification_create', methods: ['GET'])]
    public function createNotification(): Response
    {
        return $this->render('admin/notifications/create.html.twig',
            [
                'controller_name' => 'TodoController',
            ]
        );
    }

    #[Route('/create', name: '_admin_notification_create_new', methods: ['POST'])]
    public function createNewNotification(
        \Symfony\Component\HttpFoundation\Request $request,
        NotificationCounterServiceInterface $notificationCounterService,
        EntityManagerInterface $entityManager

    ): Response
    {
        $requestData = $request->request->all();
        $notification = new Notification();

        $notification->setNumberOfRepeats($requestData['notification_number_of_repeats']);
        $notification->setName($requestData['notification_name']);


        $entityManager->persist($notification);
        $entityManager->flush();


        return $this->render('admin/notifications/create.html.twig',
            [
                'controller_name' => 'TodoController',
            ]
        );
    }
}