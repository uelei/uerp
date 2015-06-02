<?php

namespace Uerp\CustomerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Uerp\CustomerBundle\Entity\CompanyPerson;
use Uerp\CustomerBundle\Form\CompanyPersonType;

/**
 * CompanyPerson controller.
 *
 */
class CompanyPersonController extends Controller
{

    /**
     * Lists all CompanyPerson entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UerpCustomerBundle:Customer')->findAll();

        return $this->render('UerpCustomerBundle:CompanyPerson:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new CompanyPerson entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new CompanyPerson();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('companyperson_show', array('id' => $entity->getId())));
        }

        return $this->render('UerpCustomerBundle:CompanyPerson:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a CompanyPerson entity.
     *
     * @param CompanyPerson $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CompanyPerson $entity)
    {
        $form = $this->createForm(new CompanyPersonType(), $entity, array(
            'action' => $this->generateUrl('companyperson_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CompanyPerson entity.
     *
     */
    public function newAction()
    {
        $entity = new CompanyPerson();
        $form   = $this->createCreateForm($entity);

        return $this->render('UerpCustomerBundle:CompanyPerson:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CompanyPerson entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpCustomerBundle:CompanyPerson')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompanyPerson entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UerpCustomerBundle:CompanyPerson:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CompanyPerson entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpCustomerBundle:CompanyPerson')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompanyPerson entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UerpCustomerBundle:CompanyPerson:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a CompanyPerson entity.
    *
    * @param CompanyPerson $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CompanyPerson $entity)
    {
        $form = $this->createForm(new CompanyPersonType(), $entity, array(
            'action' => $this->generateUrl('companyperson_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CompanyPerson entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpCustomerBundle:CompanyPerson')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompanyPerson entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('companyperson_edit', array('id' => $id)));
        }

        return $this->render('UerpCustomerBundle:CompanyPerson:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a CompanyPerson entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UerpCustomerBundle:CompanyPerson')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CompanyPerson entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('companyperson'));
    }

    /**
     * Creates a form to delete a CompanyPerson entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('companyperson_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
