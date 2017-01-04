<?php

namespace BookingsBundle\Controller;

use BookingsBundle\Entity\Booking;
use InvoiceBundle\Entity\Invoice;
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

        return $this->render('BookingsBundle::index.html.twig', array(
            'bookings' => $bookings,
        ));
    }

    /**
     * Creates a new booking entity.
     *
     * @Route("/new", name="bookings_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $booking = new Booking();
        $form = $this->createForm('BookingsBundle\Form\BookingType', $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($booking);
            $em->flush();

            $dateStart = new \DateTime($booking->getPickUpDate());
            $dateEnd = new \DateTime($booking->getDropOffDate());
            $daysNo = $dateEnd->diff($dateStart)->format("%a");

            $invoice = new Invoice();
            $invoice->setBooking($booking);
            $invoice->setVehicleRent(150);
            $invoice->setNetAmountPayable(150*$daysNo);
            $invoice->setTotalAmountPaybale(150*$daysNo);
            $invoice->setSecurityDeposit(400);

            $em->persist($invoice);
            $em->flush();

            //create invoice

            return $this->redirectToRoute('bookings_index', array('id' => $booking->getId()));
        }

        return $this->render('BookingsBundle::new.html.twig', array(
            'booking' => $booking,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing booking entity.
     *
     * @Route("/{id}/edit", name="bookings_edit")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Booking $booking
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Booking $booking)
    {
        $deleteForm = $this->createDeleteForm($booking);
        $editForm = $this->createForm('BookingsBundle\Form\BookingType', $booking);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bookings_edit', array('id' => $booking->getId()));
        }

        return $this->render('BookingsBundle::edit.html.twig', array(
            'booking' => $booking,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a booking entity.
     *
     * @Route("/{id}", name="bookings_delete")
     * @Method("DELETE")
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
