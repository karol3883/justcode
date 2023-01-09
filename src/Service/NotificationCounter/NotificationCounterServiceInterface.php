<?php

namespace App\Service\NotificationCounter;

use App\Entity\NotificationCounter;

interface NotificationCounterServiceInterface
{
    public function createNotificationCounter(NotificationCounter $notificationCounter);

    public function deleteNotificationCounter();
}