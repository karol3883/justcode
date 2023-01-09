<?php

namespace App\DataFixtures;

use App\Entity\Notification;
use App\Entity\NotificationCounter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class NotificationCounterFixtures extends Fixture implements DependentFixtureInterface
{
    private array $notifications = [
        'Podatek',
        'Rata - kuchnia',
        'ZUS',
        'Studia',
    ];

    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 5; $i++) {
//            $notificationCounter = new NotificationCounter();
//
//            $notificationCounter->
        }
    }

    public function getDependencies()
    {
        return [
            AppFixtures::class
        ];
    }
}
