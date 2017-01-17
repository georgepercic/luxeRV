<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EmailTemplates;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Emailtemplate controller.
 *
 * @Route("email-templates")
 */
class EmailTemplatesController extends Controller
{
    /**
     * Lists all emailTemplate entities.
     *
     * @Route("/", name="email-templates_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $emailTemplates = $em->getRepository('AppBundle:EmailTemplates')->findAll();

        return $this->render('emailtemplates/index.html.twig', array(
            'emailTemplates' => $emailTemplates,
        ));
    }

    /**
     * Creates a new emailTemplate entity.
     *
     * @Route("/new", name="email-templates_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $emailTemplate = new Emailtemplate();
        $form = $this->createForm('AppBundle\Form\EmailTemplatesType', $emailTemplate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($emailTemplate);
            $em->flush($emailTemplate);

            return $this->redirectToRoute('email-templates_show', array('id' => $emailTemplate->getId()));
        }

        return $this->render('emailtemplates/new.html.twig', array(
            'emailTemplate' => $emailTemplate,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a emailTemplate entity.
     *
     * @Route("/{id}", name="email-templates_show")
     * @Method("GET")
     */
    public function showAction(EmailTemplates $emailTemplate)
    {
        $deleteForm = $this->createDeleteForm($emailTemplate);

        return $this->render('emailtemplates/show.html.twig', array(
            'emailTemplate' => $emailTemplate,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing emailTemplate entity.
     *
     * @Route("/{id}/edit", name="email-templates_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EmailTemplates $emailTemplate)
    {
        $deleteForm = $this->createDeleteForm($emailTemplate);
        $editForm = $this->createForm('AppBundle\Form\EmailTemplatesType', $emailTemplate);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('email-templates_edit', array('id' => $emailTemplate->getId()));
        }

        return $this->render('emailtemplates/edit.html.twig', array(
            'emailTemplate' => $emailTemplate,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a emailTemplate entity.
     *
     * @Route("/{id}", name="email-templates_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EmailTemplates $emailTemplate)
    {
        $form = $this->createDeleteForm($emailTemplate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($emailTemplate);
            $em->flush($emailTemplate);
        }

        return $this->redirectToRoute('email-templates_index');
    }

    /**
     * Creates a form to delete a emailTemplate entity.
     *
     * @param EmailTemplates $emailTemplate The emailTemplate entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EmailTemplates $emailTemplate)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('email-templates_delete', array('id' => $emailTemplate->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
