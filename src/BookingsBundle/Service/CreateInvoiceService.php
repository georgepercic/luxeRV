<?php

namespace BookingsBundle\Service;

use BookingsBundle\Entity\Booking;
use Doctrine\ORM\Event\LifecycleEventArgs;
use InvoiceBundle\Entity\Invoice;

class CreateInvoiceService
{
    public function postPersist(LifecycleEventArgs $args)
    {
        /** @var Booking $entity */
        $entity = $args->getEntity();

        // only act on some "Booking" entity
        if (!$entity instanceof Booking) {
            return;
        }

        $entityManager = $args->getEntityManager();

        $dateStart = new \DateTime($entity->getPickUpDate());
        $dateEnd = new \DateTime($entity->getDropOffDate());
        $daysNo = $dateEnd->diff($dateStart)->format("%a");

        $invoice = new Invoice();
        $invoice->setBooking($entity->getId());
        $invoice->setVehicleRent(150);
        $invoice->setNetAmountPayable(150*$daysNo);
        $invoice->setTotalAmountPaybale(150*$daysNo);

        $entityManager->persist($invoice);
        $entityManager->flush();
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        /** @var Booking $entity */
        $entity = $args->getEntity();

        // only act on some "Booking" entity
        if (!$entity instanceof Booking) {
            return;
        }

        $entityManager = $args->getEntityManager();

        $dateStart = new \DateTime($entity->getPickUpDate());
        $dateEnd = new \DateTime($entity->getDropOffDate());
        $daysNo = $dateEnd->diff($dateStart)->format("%a");

        $invoice = new Invoice();
        $invoice->setBooking($entity->getId());
        $invoice->setVehicleRent(150);
        $invoice->setNetAmountPayable(150*$daysNo);
        $invoice->setTotalAmountPaybale(150*$daysNo);

        $entityManager->persist($invoice);
        $entityManager->flush();
    }
}