<?php

namespace App\Command;

use App\Entity\Notification;
use App\Entity\NotificationCounter;
use App\Repository\NotificationCounterRepository;
use App\Repository\NotificationRepository;
use App\Service\NotificationCounter\NotificationCounterServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntityValidator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Constraints\AllValidator;
use Symfony\Component\Validator\Constraints\Unique;
use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class NotificationCommand extends Command
{
    protected static $defaultName = 'app:send-message';

    public function __construct(
        private EntityManagerInterface $entityManager,
        private ValidatorInterface $validator,
        private NotificationCounterServiceInterface $notificationCounterService,
        private NotificationCounterRepository $notificationCounterRepository,

        string $name = 'app:send-message'
    )
    {
        parent::__construct($name);
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int
    {
        $notificationRepo = $this->entityManager->getRepository(Notification::class);
        $notifications = $notificationRepo->findAll();

        foreach ($notifications as $singleNotification) {
            $notificationCounter = new NotificationCounter();
            $notificationCounter->setLastNotification(new \DateTime());
            $notificationCounter->setNumberOfMonth(1);
            $notificationCounter->setNumberOfNotifications(1);
            $notificationCounter->setNotification($singleNotification);
            $this->notificationCounterService->createNotificationCounter($notificationCounter);
        }

        $this->notify();

        return 0;
    }

    private function notify()
    {
        $currentMonthNotifications = $this->notificationCounterRepository->getNotificationsFromMonth();

        /** @var NotificationCounter $singleNotification */
        foreach ($currentMonthNotifications as $singleNotification) {
            $numberOfRepeats = $singleNotification->getNotification()->getNumberOfRepeats();

            if (
                $numberOfRepeats >=
                $singleNotification->getNumberOfNotifications()
            ) {
                $notificationName = $singleNotification->getNotification()->getName();
                echo "$notificationName has been send, repeat number: {$singleNotification->getNumberOfNotifications()} \n";

                $this->notificationCounterRepository->markAsNotified($singleNotification);
            }
        }
    }

    private function markAsNotified()
    {

    }

    private function createNotifications()
    {

    }

    private function deleteData()
    {

    }
}