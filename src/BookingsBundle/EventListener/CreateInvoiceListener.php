<?php

namespace BookingsBundle\EventListener;

use BookingsBundle\Entity\Booking;
use BookingsBundle\Entity\Settings;
use Doctrine\ORM\Event\LifecycleEventArgs;
use InvoiceBundle\Entity\Invoice;
use VehicleBundle\Entity\Vehicle;

class CreateInvoiceListener
{
    public function postPersist(LifecycleEventArgs $args)
    {
        /** @var Booking $booking */
        $booking = $args->getEntity();

        if (!$booking instanceof Booking) {
            return;
        }

        $entityManager = $args->getEntityManager();

        $dateStart = $booking->getPickUpDate();
        $dateEnd = $booking->getDropOffDate();

        $rentDays = $this->calculateDays($dateStart, $dateEnd);
        $totalDays = $rentDays['totalDays'];
        $businessDays = $rentDays['businessDays'];
        $weekends = $totalDays - $businessDays;

        /** @var Vehicle $vehicle */
        $vehicle = $booking->getVehicle();
        $weekDayPrice = $vehicle->getWeekDayPrice();
        $weekEndPrice = $vehicle->getWeekEndPrice();

        $netVehicleRent = ($businessDays*$weekDayPrice) + ($weekEndPrice*$weekends);

        $taxRate = Settings::DEFAULT_TAX_RATE;
        $depositRate = Settings::DEFAULT_DEPOSIT_RATE;

        /** @var Settings $settings */
        $settings = $entityManager->getRepository('BookingsBundle:Settings')->findOneBy([], ['id' => 'DESC']);

        if (!empty($settings)) {
            $taxRate = $settings->getTaxRate();
            $depositRate = $settings->getDepositAmountRate();
        }

        $taxAmount = $netVehicleRent*($taxRate/100);
        $depositAmount = $netVehicleRent*($depositRate/100);
        $invoiceWithTax = $netVehicleRent + $taxAmount;
        $totalDue = $invoiceWithTax + $depositAmount;

        $invoice = new Invoice();
        $invoice->setBooking($booking);
        $invoice->setVehicleRent($netVehicleRent);
        $invoice->setNetAmountPayable($netVehicleRent);
        $invoice->setTotalAmountPaybale($totalDue);
        $invoice->setTaxRate($taxRate);
        $invoice->setTaxAmount($taxAmount);
        $invoice->setSecurityDeposit($depositAmount);

        $entityManager->persist($invoice);
        $entityManager->flush();
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        /** @var Booking $booking */
        $booking = $args->getEntity();

        if (!$booking instanceof Booking) {
            return;
        }

        $entityManager = $args->getEntityManager();
        $dateStart = $booking->getPickUpDate();
        $dateEnd = $booking->getDropOffDate();
        $daysNo = $dateEnd->diff($dateStart)->format('%a');

        $invoiceRepository = $entityManager->getRepository('InvoiceBundle:Invoice');
        $invoice = $invoiceRepository->findOneBy(['booking' => $booking->getId()]);
        $invoice->setVehicleRent(150);
        $invoice->setNetAmountPayable(150 * $daysNo);
        $invoice->setTotalAmountPaybale(150 * $daysNo);
        $invoice->setSecurityDeposit(400);

        $entityManager->persist($invoice);
        $entityManager->flush();
    }

    private function calculateDays(\DateTime $startDate, \DateTime $endDate)
    {
        $endDate->modify('+1 day');

        $interval = $endDate->diff($startDate);

        // total days
        $totalDays = $interval->days;
        $businessDays = $totalDays;

        // create an iterateable period of date (P1D equates to 1 day)
        $period = new \DatePeriod($startDate, new \DateInterval('P1D'), $endDate);

        foreach($period as $dt) {
            $curr = $dt->format('D');

            // substract if Saturday or Sunday
            if ($curr == 'Sat' || $curr == 'Sun') {
                $businessDays--;
            }
        }

        return ['totalDays' => $totalDays, 'businessDays' => $businessDays];
    }

}
