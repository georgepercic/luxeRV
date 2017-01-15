<?php

namespace BookingsBundle\Controller;

use BookingsBundle\Entity\Settings;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Setting controller.
 *
 * @Route("settings")
 */
class SettingsController extends Controller
{
    /**
     * Lists all setting entities.
     *
     * @Route("/", name="settings_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $settings = $em->getRepository('BookingsBundle:Settings')->findAll();

        return $this->render('BookingsBundle::settings/index.html.twig', array(
            'settings' => $settings,
        ));
    }

    /**
     * Creates a new setting entity.
     *
     * @Route("/new", name="settings_new")
     * @Method({"GET", "POST"})
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $setting = new Setting();
        $form = $this->createForm('BookingsBundle\Form\SettingsType', $setting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($setting);
            $em->flush($setting);

            return $this->redirectToRoute('settings_index', array('id' => $setting->getId()));
        }

        return $this->render('BookingsBundle::settings/new.html.twig', array(
            'setting' => $setting,
            'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing setting entity.
     *
     * @Route("/{id}/edit", name="settings_edit")
     * @Method({"GET", "POST"})
     * @param Request  $request
     * @param Settings $setting
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Settings $setting)
    {
        $deleteForm = $this->createDeleteForm($setting);
        $editForm = $this->createForm('BookingsBundle\Form\SettingsType', $setting);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('settings_edit', array('id' => $setting->getId()));
        }

        return $this->render('BookingsBundle::settings/edit.html.twig', array(
            'setting' => $setting,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a setting entity.
     *
     * @Route("/{id}", name="settings_delete")
     * @Method("DELETE")
     * @param Request  $request
     * @param Settings $setting
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Settings $setting)
    {
        $form = $this->createDeleteForm($setting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($setting);
            $em->flush($setting);
        }

        return $this->redirectToRoute('settings_index');
    }

    /**
     * Creates a form to delete a setting entity.
     *
     * @param Settings $setting The setting entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Settings $setting)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('settings_delete', array('id' => $setting->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
