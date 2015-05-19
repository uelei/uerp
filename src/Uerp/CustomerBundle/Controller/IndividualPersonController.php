<?php

namespace Uerp\CustomerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Uerp\CustomerBundle\Entity\IndividualPerson;
use Uerp\CustomerBundle\Form\IndividualPersonType;

/**
 * IndividualPerson controller.
 *
 */
class IndividualPersonController extends Controller
{

    /**
     * Lists all IndividualPerson entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UerpCustomerBundle:IndividualPerson')->findAll();

        return $this->render('UerpCustomerBundle:IndividualPerson:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new IndividualPerson entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new IndividualPerson();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('individualperson_show', array('id' => $entity->getId())));
        }

        return $this->render('UerpCustomerBundle:IndividualPerson:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a IndividualPerson entity.
     *
     * @param IndividualPerson $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(IndividualPerson $entity)
    {
        $form = $this->createForm(new IndividualPersonType(), $entity, array(
            'action' => $this->generateUrl('individualperson_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new IndividualPerson entity.
     *
     */
    public function newAction()
    {
        $entity = new IndividualPerson();
        $form   = $this->createCreateForm($entity);

        return $this->render('UerpCustomerBundle:IndividualPerson:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a IndividualPerson entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpCustomerBundle:IndividualPerson')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find IndividualPerson entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UerpCustomerBundle:IndividualPerson:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing IndividualPerson entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpCustomerBundle:IndividualPerson')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find IndividualPerson entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UerpCustomerBundle:IndividualPerson:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a IndividualPerson entity.
    *
    * @param IndividualPerson $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(IndividualPerson $entity)
    {
        $form = $this->createForm(new IndividualPersonType(), $entity, array(
            'action' => $this->generateUrl('individualperson_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing IndividualPerson entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpCustomerBundle:IndividualPerson')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find IndividualPerson entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('individualperson_edit', array('id' => $id)));
        }

        return $this->render('UerpCustomerBundle:IndividualPerson:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a IndividualPerson entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UerpCustomerBundle:IndividualPerson')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find IndividualPerson entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('individualperson'));
    }

    /**
     * Creates a form to delete a IndividualPerson entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('individualperson_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
