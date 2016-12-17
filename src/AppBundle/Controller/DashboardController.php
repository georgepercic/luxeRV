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

        return $this->render('AppBundle:booking-dashboard:operations.html.twig', array(
            'bookings' => $bookings,
        ));
    }

}
