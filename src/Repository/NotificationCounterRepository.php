<?php

namespace App\Repository;

use App\Entity\Notification;
use App\Entity\NotificationCounter;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NotificationCounter>
 *
 * @method NotificationCounter|null find($id, $lockMode = null, $lockVersion = null)
 * @method NotificationCounter|null findOneBy(array $criteria, array $orderBy = null)
 * @method NotificationCounter[]    findAll()
 * @method NotificationCounter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotificationCounterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NotificationCounter::class);
    }

    /**
     * @param NotificationCounter $entity
     * @param bool $flush
     * @return void
     */
    public function add(NotificationCounter $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @param NotificationCounter $entity
     * @param bool $flush
     * @return void
     */
    public function remove(NotificationCounter $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @param DateTime $currentDateTime
     * @return NotificationCounter[]
     */
    public function getNotificationsFromMonth(DateTime $currentDateTime = new DateTime()): array
    {
       return $this->findBy([
           'numberOfMonth' => (int) $currentDateTime->format('m'),
       ]);
    }

    public function markAsNotified(NotificationCounter $notificationCounter)
    {
        $notificationCounter->setNumberOfNotifications($notificationCounter->getNumberOfNotifications() + 1);
        $notificationCounter->setLastNotification(new DateTime());

        $this->_em->persist($notificationCounter);
        $this->_em->flush();
    }

}
