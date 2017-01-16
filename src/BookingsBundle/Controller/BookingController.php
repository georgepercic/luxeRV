<?php

namespace BookingsBundle\Controller;

use AppBundle\Service\GeoService;
use AppBundle\Service\SettingsService;
use BookingsBundle\Entity\Booking;
use BookingsBundle\Entity\Settings;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Booking controller.
 *
 * @Route("bookings")
 */
class BookingController extends Controller
{
    /**
     * Lists all booking entities.
     *
     * @Route("/", name="bookings_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bookings = $em->getRepository('BookingsBundle:Booking')->findAll();

        return $this->render('BookingsBundle::bookings/index.html.twig', array(
            'bookings' => $bookings,
        ));
    }

    /**
     * Creates a new booking entity.
     *
     * @Route("/new", name="bookings_new")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        /** @var GeoService $geoService */
        $geoService = $this->get('app.geo_service');

        /** @var SettingsService $settingsService */
        $settingsService = $this->get('app.settings_service');

        $booking = new Booking();
        $form = $this->createForm('BookingsBundle\Form\BookingType', $booking);
        $form->handleRequest($request);

        $vars = $request->request->get('bookingsbundle_booking', []);

        $pickUpLocationString = !empty($vars['pickUpLocation']) ? $vars['pickUpLocation'] : '';
        $dropOffLocationString = !empty($vars['dropOffLocation']) ? $vars['dropOffLocation'] : '';

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            if (!empty($pickUpLocationString)) {
                /** @var \stdClass $pickUpLocation */
                $pickUpLocation = $geoService->geoCodeAddress($pickUpLocationString);

                if (false !== $pickUpLocation && isset($pickUpLocation->lat)) {
                    $booking->setPickupLocationLatitude($pickUpLocation->lat);
                    $booking->setPickupLocationLongitude($pickUpLocation->lng);
                }
            }

            if (!empty($dropOffLocationString)) {
                /** @var \stdClass $dropOffLocation */
                $dropOffLocation = $geoService->geoCodeAddress($dropOffLocationString);

                if (false !== $dropOffLocation && isset($dropOffLocation->lat)) {
                    $booking->setDropOffLocationLatitude($dropOffLocation->lat);
                    $booking->setDropOffLocationLongitude($dropOffLocation->lng);
                }
            }

            $em->persist($booking);
            $em->flush();

            return $this->redirectToRoute('bookings_index', array('id' => $booking->getId()));
        }

        /** @var Settings|false $settingVars */
        $settingVars = $settingsService->getCurrentAppSettings();

        $timeVars = [];

        if (false !== $settingVars) {
            $timeVars['delivery'] = $settingVars->getDefaultPickUpTime()->format('H:i');
            $timeVars['return'] = $settingVars->getDefaultDropOffTime()->format('H:i');
            $timeVars['minDays'] = $settingVars->getDefaultMinRentDays();
        }

        return $this->render('BookingsBundle::bookings/new.html.twig', array(
            'booking' => $booking,
            'form' => $form->createView(),
            'timeVars' => $timeVars,
        ));
    }

    /**
     * Displays a form to edit an existing booking entity.
     *
     * @Route("/{id}/edit", name="bookings_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param Booking $booking
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Booking $booking)
    {
        /** @var GeoService $geoService */
        $geoService = $this->get('app.geo_service');

        /** @var SettingsService $settingsService */
        $settingsService = $this->get('app.settings_service');

        $deleteForm = $this->createDeleteForm($booking);
        $editForm = $this->createForm('BookingsBundle\Form\BookingType', $booking);
        $editForm->handleRequest($request);

        $vars = $request->request->get('bookingsbundle_booking', []);

        $pickUpLocationString = !empty($vars['pickUpLocation']) ? $vars['pickUpLocation'] : '';
        $dropOffLocationString = !empty($vars['dropOffLocation']) ? $vars['dropOffLocation'] : '';

        $bookingStatus = !empty($vars['bookingStatus']) ? $vars['bookingStatus'] : Booking::STATUS_RESERVED;

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if (!empty($pickUpLocationString)) {
                /** @var \stdClass $pickUpLocation */
                $pickUpLocation = $geoService->geoCodeAddress($pickUpLocationString);

                if (false !== $pickUpLocation && isset($pickUpLocation->lat)) {
                    $booking->setPickupLocationLatitude($pickUpLocation->lat);
                    $booking->setPickupLocationLongitude($pickUpLocation->lng);
                }
            }

            if (!empty($dropOffLocationString)) {
                /** @var \stdClass $dropOffLocation */
                $dropOffLocation = $geoService->geoCodeAddress($dropOffLocationString);

                if (false !== $dropOffLocation && isset($dropOffLocation->lat)) {
                    $booking->setDropOffLocationLatitude($dropOffLocation->lat);
                    $booking->setDropOffLocationLongitude($dropOffLocation->lng);
                }
            }

            $booking->setBookingStatus($bookingStatus);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bookings_edit', array('id' => $booking->getId()));
        }

        /** @var Settings|false $settingVars */
        $settingVars = $settingsService->getCurrentAppSettings();

        $timeVars = [];

        if (false !== $settingVars) {
            $timeVars['delivery'] = $settingVars->getDefaultPickUpTime()->format('H:i');
            $timeVars['return'] = $settingVars->getDefaultDropOffTime()->format('H:i');
            $timeVars['minDays'] = $settingVars->getDefaultMinRentDays();
        }

        return $this->render('BookingsBundle::bookings/edit.html.twig', array(
            'booking' => $booking,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'timeVars' => $timeVars,
        ));
    }

    /**
     * Deletes a booking entity.
     *
     * @Route("/{id}", name="bookings_delete")
     * @Method("DELETE")
     *
     * @param Request $request
     * @param Booking $booking
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Booking $booking)
    {
        $form = $this->createDeleteForm($booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //delete invoice
            $invoice = $em->getRepository('InvoiceBundle:Invoice')->findOneBy(['booking' => $booking->getId()]);
            $em->remove($invoice);
            //delete booking
            $em->remove($booking);
            $em->flush($booking);
        }

        return $this->redirectToRoute('bookings_index');
    }

    /**
     * Creates a form to delete a booking entity.
     *
     * @param Booking $booking The booking entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Booking $booking)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bookings_delete', array('id' => $booking->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
