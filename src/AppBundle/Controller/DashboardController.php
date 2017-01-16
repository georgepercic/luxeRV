<?php

namespace AppBundle\Controller;

use BookingsBundle\Entity\Booking;
use CustomerBundle\Entity\Customer;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VehicleBundle\Entity\Vehicle;

class DashboardController extends Controller
{
    /**
     * List booking operations.
     *
     * @Route("/", name="booking_operations")
     * @Method("GET")
     */
    public function operations()
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        /** @var ArrayCollection $bookings */
        $bookings = $em->getRepository('BookingsBundle:Booking')->findAll();

        /** @var ArrayCollection $cars */
        $cars = $em->getRepository('VehicleBundle:Vehicle')->findAll();

        /** @var ArrayCollection $customers */
        $customers = $em->getRepository('CustomerBundle:Customer')->findAll();

        $sections = [];
        $selectCars = [];
        $selectCustomers = [];
        $data = [];

        if (!empty($cars)) {
            /** @var Vehicle $car */
            foreach ($cars as $car) {
                $sections[] = [
                    'key' => $car->getId(),
                    'label' => sprintf(
                        $this->getImageTemplate(),
                        $car->getBrand(),
                        $car->getModel(),
                        $car->getVin(),
                        !empty($car->getUnitNumber()) ? 'Unit # '.$car->getUnitNumber() : ''
                    ),
                ];

                $selectCars[] = [
                    'id' => $car->getId(),
                    'text' => $car->getVinBrandModel(),
                ];
            }
        }

        if (!empty($customers)) {
            /** @var Customer $customer */
            foreach ($customers as $customer) {
                $selectCustomers[] = [
                    'id' => $customer->getId(),
                    'text' => $customer->getName(),
                ];
            }
        }

        if (!empty($bookings)) {
            /** @var Booking $booking */
            foreach ($bookings as $booking) {
                $data[] = [
                    'start_date' => $booking->getPickUpDate()->format('Y-m-d, H:i'),
                    'end_date' => $booking->getDropOffDate()->format('Y-m-d, H:i'),
                    'text' => $booking->getCustomer()->getName(),
                    'customer_id' => $booking->getCustomer()->getId(),
                    'section_id' => $booking->getVehicle()->getId(),
                    'booking_id' => $booking->getId(),
                ];
            }
        }

        $sections = json_encode($sections, true);
        $data = json_encode($data, true);
        $selectCars = json_encode($selectCars, true);
        $selectCustomers = json_encode($selectCustomers, true);
        $bookingStatuses = json_encode([
            Booking::STATUS_ACCEPTED,
            Booking::STATUS_CLOSED,
            Booking::STATUS_COMPLETED,
            Booking::STATUS_RESERVED,
        ]);

        return $this->render('AppBundle:booking-dashboard:operations.html.twig', [
            'bookings' => $data,
            'sections' => $sections,
            'selectCars' => $selectCars,
            'selectCustomers' => $selectCustomers,
            'bookingStatuses' => $bookingStatuses,
        ]);
    }

    /**
     * Creates a new booking entity.
     *
     * @Route("/ajax-new-booking", name="ajax_bookings_new")
     * @Method({"POST"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function ajaxCreateBookingAction(Request $request)
    {
        $request = $request->request;

        if (!empty($request->get('customer_id')) && !empty($request->get('section_id'))) {
            $em = $this->getDoctrine()->getManager();
            $customer = $em->getRepository('CustomerBundle:Customer')->find($request->get('customer_id'));
            $vehicle = $em->getRepository('VehicleBundle:Vehicle')->find($request->get('section_id'));
            $pickUpDate = date('Y-m-d H:i:s', strtotime($request->get('start_date')));
            $dropOffDate = date('Y-m-d H:i:s', strtotime($request->get('end_date')));

            $booking = new Booking();
            $booking->setCustomer($customer);
            $booking->setVehicle($vehicle);
            $booking->setPickUpDate($pickUpDate);
            $booking->setDropOffDate($dropOffDate);

            $em->persist($booking);
            $em->flush();

            $serializedEntity = $this->get('serializer')->serialize($booking, 'json');

            return new Response($serializedEntity);
        }

        $response = new Response();
        $response->setStatusCode(500);

        return $response;
    }

    /**
     * Updates an existing booking entity.
     *
     * @Route("/ajax-edit-booking", name="ajax_bookings_edit")
     * @Method({"POST"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function ajaxEditBookingAction(Request $request)
    {
        $request = $request->request;

        if (!empty($request->get('customer_id')) && !empty($request->get('section_id')) && !empty($request->get('booking_id'))) {
            $em = $this->getDoctrine()->getManager();
            $customer = $em->getRepository('CustomerBundle:Customer')->find($request->get('customer_id'));
            $vehicle = $em->getRepository('VehicleBundle:Vehicle')->find($request->get('section_id'));
            $pickUpDate = date('Y-m-d H:i:s', strtotime($request->get('start_date')));
            $dropOffDate = date('Y-m-d H:i:s', strtotime($request->get('end_date')));

            /** @var Booking $booking */
            $booking = $em->getRepository('BookingsBundle:Booking')->find($request->get('booking_id'));
            if (!empty($booking)) {
                $booking->setCustomer($customer);
                $booking->setVehicle($vehicle);
                $booking->setPickUpDate($pickUpDate);
                $booking->setDropOffDate($dropOffDate);

                $em->persist($booking);
                $em->flush();

                $serializedEntity = $this->get('serializer')->serialize($booking, 'json');

                return new Response($serializedEntity);
            }
        }

        $response = new Response();
        $response->setStatusCode(500);

        return $response;
    }

    /**
     * Delete an existing booking entity.
     *
     * @Route("/ajax-delete-booking", name="ajax_bookings_delete")
     * @Method({"POST"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function ajaxDeleteBooking(Request $request)
    {
        $request = $request->request;

        if (!empty($request->get('booking_id'))) {
            $em = $this->getDoctrine()->getManager();
            //delete invoice
            $invoice = $em->getRepository('InvoiceBundle:Invoice')->findOneBy(['booking' => $request->get('booking_id')]);
            $em->remove($invoice);
            //delete booking
            $booking = $em->getRepository('BookingsBundle:Booking')->find($request->get('booking_id'));
            $em->remove($booking);
            $em->flush();

            return new Response();
        }

        $response = new Response();
        $response->setStatusCode(500);

        return $response;
    }

    /**
     * @return string
     */
    private function getImageTemplate()
    {
        $html = <<<'HTML'
        <div class="row">
            <div class="col-md-3">
                <i class="fa fa-bus fa-3x" style="color:#8a3c07;" aria-hidden="true"></i>
            </div>
            <div class="col-md-9" style="text-align: left;">
                <span><strong>%s %s</strong></span><br/>
                <span>%s</span><br/>
                <span>%s</span>
            </div>
        </div>
HTML;

        return $html;
    }
}
