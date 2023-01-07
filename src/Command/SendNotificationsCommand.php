<?php

namespace App\Command;

use App\Repository\NotificationCounterRepository;
use App\Service\NotificationCounter\NotificationCounterServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Mime\Email;

class SendNotificationsCommand extends Command
{
    protected static $defaultName = 'app:notyf';

    /**
     * @param NotificationCounterRepository|null $notificationCounterRepository
     * @param MailerInterface|null $mailer
     * @param string $name
     */
    public function __construct(
        private ?NotificationCounterRepository $notificationCounterRepository,
        private ?MailerInterface $mailer,
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
        $this->sendNotifications();
        return 0;
    }

    private function sendNotifications()
    {
        $notifications = $this->notificationCounterRepository->getNotificationsFromMonth();

        foreach ($notifications as $singleNotification) {
            $name = $singleNotification->getNotification()->getName();

            $email = (new Email())
                ->from('karol3883@karol3883.smallhost.pl')
                ->to('karol3883@gmail.com')
                ->subject("Powiadomienie - $name 456")
                ->text("Powiadomienie - $name 123")
                ->html("
                    <b> $name </b> - do opłacenia!
                ");

            $this->mailer->send($email);
            break;
        }
//        dd($notifications);
//        $this->mailer->send($email);
    }
}