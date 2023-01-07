<?php

namespace App\DataFixtures;

use App\Entity\Notification;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private array $notifications = [
        'Podatek',
        'Rata - kuchnia',
        'ZUS',
        'Studia',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach($this->notifications as $notificationName) {
            $notification = new Notification();
            $notification->setName($notificationName);
            $notification->setNumberOfRepeats(3);

            $manager->persist($notification);
        }
        $manager->flush();
    }
}
