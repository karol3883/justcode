<?php

namespace App\Entity;

use App\Repository\NotificationCounterRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=NotificationCounterRepository::class)
 */
class NotificationCounter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfMonth;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfNotifications;

    /**
     * @ORM\Column(type="date")
     */
    private $lastNotification;

    /**
     * @ORM\ManyToOne(targetEntity=Notification::class, inversedBy="notificationCounters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Notification;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberOfMonth(): ?int
    {
        return $this->numberOfMonth;
    }

    public function setNumberOfMonth(int $numberOfMonth): self
    {
        $this->numberOfMonth = $numberOfMonth;

        return $this;
    }

    public function getNumberOfNotifications(): ?int
    {
        return $this->numberOfNotifications;
    }

    public function setNumberOfNotifications(int $numberOfNotifications): self
    {
        $this->numberOfNotifications = $numberOfNotifications;

        return $this;
    }

    public function getLastNotification(): ?\DateTimeInterface
    {
        return $this->lastNotification;
    }

    public function setLastNotification(\DateTimeInterface $lastNotification): self
    {
        $this->lastNotification = $lastNotification;

        return $this;
    }

    public function getNotification(): ?Notification
    {
        return $this->Notification;
    }

    public function setNotification(?Notification $Notification): self
    {
        $this->Notification = $Notification;

        return $this;
    }
}
