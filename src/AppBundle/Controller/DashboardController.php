<?php

namespace AppBundle\Controller;

use BookingsBundle\Entity\Booking;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $em = $this->getDoctrine()->getManager();

        $bookings = $em->getRepository('BookingsBundle:Booking')->findAll();
        $cars = $em->getRepository('VehicleBundle:Vehicle')->findAll();
        $customers = $em->getRepository('CustomerBundle:Customer')->findAll();
        $sections = [];
        $selectCars = [];
        $selectCustomers = [];
        $data = [];

        if (!empty($cars)) {
            foreach ($cars as $car) {
                $sections[] = [
                    'key' => $car->getId(),
                    'label' => sprintf('<img src="/luxeRV/web/assets/images/sedan-512.png" style="width: 30%%; height: auto;" /> <br /> %s', $car->getVinBrandModel()),
                ];

                $selectCars[] = [
                    'id' => $car->getId(),
                    'text' => $car->getVinBrandModel(),
                ];
            }
        }

        if (!empty($customers)) {
            foreach ($customers as $customer) {
                $selectCustomers[] = [
                    'id' => $customer->getId(),
                    'text' => $customer->getName(),
                ];
            }
        }

        if (!empty($bookings)) {
            foreach ($bookings as $booking) {
                $data[] = [
                    'start_date' => $booking->getPickUpDate(),
                    'end_date' => $booking->getDropOffDate(),
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

        return $this->render('AppBundle:booking-dashboard:operations.html.twig', array(
            'bookings' => $data,
            'sections' => $sections,
            'selectCars' => $selectCars,
            'selectCustomers' => $selectCustomers,
        ));
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
            $pickUpDate = new \DateTime($request->get('start_date'));
            $dropOffDate = new \DateTime($request->get('end_date'));

            $booking = new Booking();
            $booking->setCustomer($customer);
            $booking->setVehicle($vehicle);
            $booking->setPickUpDate($pickUpDate->format('Y-m-d H:i'));
            $booking->setDropOffDate($dropOffDate->format('Y-m-d H:i'));

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
            $pickUpDate = new \DateTime($request->get('start_date'));
            $dropOffDate = new \DateTime($request->get('end_date'));

            $booking = $em->getRepository('BookingsBundle:Booking')->find($request->get('booking_id'));
            if (!empty($booking)) {
                $booking->setCustomer($customer);
                $booking->setVehicle($vehicle);
                $booking->setPickUpDate($pickUpDate->format('Y-m-d H:i'));
                $booking->setDropOffDate($dropOffDate->format('Y-m-d H:i'));

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
}
