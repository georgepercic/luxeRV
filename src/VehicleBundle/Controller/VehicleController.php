<?php

namespace VehicleBundle\Controller;

use VehicleBundle\Entity\Vehicle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Vehicle controller.
 *
 * @Route("vehicles")
 */
class VehicleController extends Controller
{
    /**
     * Lists all vehicle entities.
     *
     * @Route("/", name="vehicles_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $vehicles = $em->getRepository('VehicleBundle:Vehicle')->findAll();

        return $this->render('VehicleBundle::index.html.twig', array(
            'vehicles' => $vehicles,
        ));
    }

    /**
     * Creates a new vehicle entity.
     *
     * @Route("/new", name="vehicles_new")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $vehicle = new Vehicle();
        $form = $this->createForm('VehicleBundle\Form\VehicleType', $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vehicle);
            $em->flush($vehicle);

            return $this->redirectToRoute('vehicles_index', array('id' => $vehicle->getId()));
        }

        return $this->render('VehicleBundle::new.html.twig', array(
            'vehicle' => $vehicle,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a vehicle entity.
     *
     * @Route("/{id}", name="vehicles_show")
     * @Method("GET")
     *
     * @param Vehicle $vehicle
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Vehicle $vehicle)
    {
        $deleteForm = $this->createDeleteForm($vehicle);

        return $this->render('VehicleBundle::show.html.twig', array(
            'vehicle' => $vehicle,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing vehicle entity.
     *
     * @Route("/{id}/edit", name="vehicles_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param Vehicle $vehicle
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Vehicle $vehicle)
    {
        $deleteForm = $this->createDeleteForm($vehicle);
        $editForm = $this->createForm('VehicleBundle\Form\VehicleType', $vehicle);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vehicles_edit', array('id' => $vehicle->getId()));
        }

        return $this->render('VehicleBundle::edit.html.twig', array(
            'vehicle' => $vehicle,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a vehicle entity.
     *
     * @Route("/{id}", name="vehicles_delete")
     * @Method("DELETE")
     *
     * @param Request $request
     * @param Vehicle $vehicle
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Vehicle $vehicle)
    {
        $form = $this->createDeleteForm($vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($vehicle);
            $em->flush($vehicle);
        }

        return $this->redirectToRoute('vehicles_index');
    }

    /**
     * Creates a form to delete a vehicle entity.
     *
     * @param Vehicle $vehicle The vehicle entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Vehicle $vehicle)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vehicles_delete', array('id' => $vehicle->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
