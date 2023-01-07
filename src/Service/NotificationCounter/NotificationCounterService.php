<?php

namespace App\Service\NotificationCounter;

use App\Entity\Notification;
use App\Entity\NotificationCounter;
use Doctrine\ORM\EntityManagerInterface;

class NotificationCounterService implements NotificationCounterServiceInterface
{

    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function createNotificationCounter(NotificationCounter $notificationCounter)
    {
        try {
            $this->validNotificationCounter($notificationCounter);

            $this->entityManager->persist($notificationCounter);
            $this->entityManager->flush();

        } catch (\Exception $exception) {
            echo "{$exception->getMessage()} \n";
        }

    }

    public function deleteNotificationCounter()
    {
        // TODO: Implement deleteNotificationCounter() method.
    }

    private function validNotificationCounter(NotificationCounter $notificationCounter)
    {
        $notificationId = $this->entityManager
            ->getRepository(NotificationCounter::class);

        /** @var NotificationCounter $notificationCounter */
        $notificationCounter = $notificationId->findOneBy([
            'numberOfMonth' => $notificationCounter->getNumberOfMonth(),
            'Notification' => $notificationCounter->getNotification()
        ]);


        if (null !== $notificationCounter) {
            throw new \Exception(sprintf(
                "The counter exits for %s month: %s",
                $notificationCounter->getNumberOfMonth(),
                $notificationCounter->getNotification()->getName()
                )
            );
        }
    }

    public function getNotificationCounterByNotification(Notification $notification): NotificationCounter
    {
//        $notificationCounterRepository = $this->entityManager->
//        $notificationCounter = $this->
    }
}