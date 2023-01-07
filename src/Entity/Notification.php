<?php

namespace App\Entity;

use App\Repository\NotificationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NotificationRepository::class)
 */
class Notification
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfRepeats;

    /**
     * @ORM\OneToMany(targetEntity=NotificationCounter::class, mappedBy="Notification")
     */
    private $notificationCounters;

    public function __construct()
    {
        $this->notificationCounters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNumberOfRepeats(): ?int
    {
        return $this->numberOfRepeats;
    }

    public function setNumberOfRepeats(int $numberOfRepeats): self
    {
        $this->numberOfRepeats = $numberOfRepeats;

        return $this;
    }

    /**
     * @return Collection<int, NotificationCounter>
     */
    public function getNotificationCounters(): Collection
    {
        return $this->notificationCounters;
    }

    public function addNotificationCounter(NotificationCounter $notificationCounter): self
    {
        if (!$this->notificationCounters->contains($notificationCounter)) {
            $this->notificationCounters[] = $notificationCounter;
            $notificationCounter->setNotification($this);
        }

        return $this;
    }

    public function removeNotificationCounter(NotificationCounter $notificationCounter): self
    {
        if ($this->notificationCounters->removeElement($notificationCounter)) {
            // set the owning side to null (unless already changed)
            if ($notificationCounter->getNotification() === $this) {
                $notificationCounter->setNotification(null);
            }
        }

        return $this;
    }
}
