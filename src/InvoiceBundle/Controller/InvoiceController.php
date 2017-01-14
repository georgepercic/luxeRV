<?php

namespace InvoiceBundle\Controller;

use InvoiceBundle\Entity\Invoice;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Invoice controller.
 *
 * @Route("invoices")
 */
class InvoiceController extends Controller
{
    /**
     * Lists all invoice entities.
     *
     * @Route("/", name="invoices_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $invoices = $em->getRepository('InvoiceBundle:Invoice')->findAll();

        return $this->render('InvoiceBundle::index.html.twig', array(
            'invoices' => $invoices,
        ));
    }

    /**
     * Finds and displays a invoice entity.
     *
     * @Route("/{id}", name="invoices_show")
     * @Method("GET")
     *
     * @param Invoice $invoice
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Invoice $invoice)
    {
        return $this->render('InvoiceBundle::show.html.twig', array(
            'invoice' => $invoice,
        ));
    }
}
