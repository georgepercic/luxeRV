<?php

namespace BookingsBundle\EventListener;

use BookingsBundle\Entity\Booking;
use Doctrine\ORM\Event\OnFlushEventArgs;
use InvoiceBundle\Entity\Invoice;

class CreateInvoiceListener
{
    public function onFlush(OnFlushEventArgs $args)
    {
        $entityManager = $args->getEntityManager();
//        die('ajungeee');

        $uow = $entityManager->getUnitOfWork();
        foreach ($uow->getScheduledEntityInsertions() as $entity) {
            if ($entity instanceof Booking) {
                $dateStart = new \DateTime($entity->getPickUpDate());
                $dateEnd = new \DateTime($entity->getDropOffDate());
                $daysNo = $dateEnd->diff($dateStart)->format("%a");

                $invoice = new Invoice();
                $invoice->setBooking($entity);
                $invoice->setVehicleRent(150);
                $invoice->setNetAmountPayable(150*$daysNo);
                $invoice->setTotalAmountPaybale(150*$daysNo);
                $invoice->setSecurityDeposit(400);

                $entityManager->persist($invoice);
                $entityManager->flush();
            }
        }
    }
}