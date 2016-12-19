<?php

namespace NotificationsBundle\Controller;

use NotificationsBundle\Entity\Notification;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NotificationsController.
 *
 * @Route("notifications")
 */
class NotificationsController extends Controller
{
    /**
     * Creates a new notification.
     *
     * @Route("/new", name="notifications_new")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newNotification(Request $request)
    {
        $notification = new Notification();
        $form = $this->createForm('NotificationsBundle\Form\NotificationType', $notification);
        $form->handleRequest($request);

//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($notification);
//            $em->flush($notification);

//            return $this->redirectToRoute('bookings_show', array('id' => $notification->getId()));
//        }

        return $this->render('NotificationsBundle::new.html.twig', array(
            'notification' => $notification,
            'form' => $form->createView(),
        ));
    }
}
