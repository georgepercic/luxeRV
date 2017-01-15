<?php

namespace EmployeeBundle\Controller;

use EmployeeBundle\Entity\Employee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Employee controller.
 *
 * @Route("employees")
 */
class EmployeeController extends Controller
{
    /**
     * Lists all employee entities.
     *
     * @Route("/", name="employees_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $employees = $em->getRepository('EmployeeBundle:Employee')->findAll();

        return $this->render('EmployeeBundle::index.html.twig', array(
            'employees' => $employees,
        ));
    }

    /**
     * Creates a new employee entity.
     *
     * @Route("/new", name="employees_new")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $employee = new Employee();
        $form = $this->createForm('EmployeeBundle\Form\EmployeeType', $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush($employee);

            return $this->redirectToRoute('employees_show', array('id' => $employee->getId()));
        }

        return $this->render('EmployeeBundle::new.html.twig', array(
            'employee' => $employee,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays an employee entity.
     *
     * @Route("/{id}", name="employees_show")
     * @Method("GET")
     *
     * @param Employee $employee
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Employee $employee)
    {
        $deleteForm = $this->createDeleteForm($employee);

        return $this->render('EmployeeBundle::show.html.twig', array(
            'employee' => $employee,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing employee entity.
     *
     * @Route("/{id}/edit", name="employees_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request  $request
     * @param Employee $employee
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Employee $employee)
    {
        $deleteForm = $this->createDeleteForm($employee);
        $editForm = $this->createForm('EmployeeBundle\Form\EmployeeType', $employee);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('employees_edit', array('id' => $employee->getId()));
        }

        return $this->render('EmployeeBundle::edit.html.twig', array(
            'employee' => $employee,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes an employee entity.
     *
     * @Route("/{id}", name="employees_delete")
     * @Method("DELETE")
     *
     * @param Request  $request
     * @param Employee $employee
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Employee $employee)
    {
        $form = $this->createDeleteForm($employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($employee);
            $em->flush($employee);
        }

        return $this->redirectToRoute('employees_index');
    }

    /**
     * Creates a form to delete a employee entity.
     *
     * @param Employee $employee The employee entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Employee $employee)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('employees_delete', array('id' => $employee->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
