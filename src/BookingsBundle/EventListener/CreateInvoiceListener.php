<?php

namespace BookingsBundle\EventListener;

use BookingsBundle\Entity\Booking;
use Doctrine\ORM\Event\LifecycleEventArgs;
use InvoiceBundle\Entity\Invoice;

class CreateInvoiceListener
{
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Booking) {
            return;
        }

        $entityManager = $args->getEntityManager();
        $dateStart = new \DateTime($entity->getPickUpDate());
        $dateEnd = new \DateTime($entity->getDropOffDate());
        $daysNo = $dateEnd->diff($dateStart)->format('%a');

        $invoice = new Invoice();
        $invoice->setBooking($entity);
        $invoice->setVehicleRent(150);
        $invoice->setNetAmountPayable(150 * $daysNo);
        $invoice->setTotalAmountPaybale(150 * $daysNo);
        $invoice->setSecurityDeposit(400);

        $entityManager->persist($invoice);
        $entityManager->flush();
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Booking) {
            return;
        }

        $entityManager = $args->getEntityManager();
        $dateStart = new \DateTime($entity->getPickUpDate());
        $dateEnd = new \DateTime($entity->getDropOffDate());
        $daysNo = $dateEnd->diff($dateStart)->format('%a');

        $invoiceRepository = $entityManager->getRepository('InvoiceBundle:Invoice');
        $invoice = $invoiceRepository->findOneBy(['booking' => $entity->getId()]);
        $invoice->setVehicleRent(150);
        $invoice->setNetAmountPayable(150 * $daysNo);
        $invoice->setTotalAmountPaybale(150 * $daysNo);
        $invoice->setSecurityDeposit(400);

        $entityManager->persist($invoice);
        $entityManager->flush();
    }
}
