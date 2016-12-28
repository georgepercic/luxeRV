<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends Controller
{
    /**
     * @Route("/dummy", name="homepage")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
//    public function indexAction(Request $request)
//    {
//        // replace this example code with whatever you need
//        return $this->render('AppBundle::dashboard.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
//        ]);
//    }

    /**
     * List booking operations
     *
     * @Route("/", name="booking_operations")
     * @Method("GET")
     */
    public function operations()
    {
        $em = $this->getDoctrine()->getManager();

        $bookings = $em->getRepository('BookingsBundle:Booking')->findAll();
        $cars = $em->getRepository('VehicleBundle:Vehicle')->findAll();
        $sections = [];
        $data = [];
        if (!empty($cars)) {
            foreach ($cars as $car) {
                $sections[] = [
                    'key' => $car->getId(),
                    'label' =>  sprintf('<img src="/assets/images/sedan-512.png" style="width: 30%%; height: auto;" /> %s', $car->getVinBrandModel()),
                ];
            }
        }

        if (!empty($bookings)) {
            foreach ($bookings as $booking) {
                $data[] = [
                    'start_date' => $booking->getPickUpDate(),
                    'end_date' => $booking->getDropOffDate(),
                    'text' => $booking->getCustomer()->getName(),
                    'details' => 'blablavbla',
                    'section_id' => $booking->getVehicle()->getId(),
                ];
            }
        }

        $sections = json_encode($sections, true);
        $data = json_encode($data, true);

        return $this->render('AppBundle:booking-dashboard:operations.html.twig', array(
            'bookings' => $data,
            'sections' => $sections,
        ));
    }

}
