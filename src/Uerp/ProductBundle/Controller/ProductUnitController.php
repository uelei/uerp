<?php

namespace Uerp\ProductBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Uerp\ProductBundle\Entity\ProductUnit;
use Uerp\ProductBundle\Form\ProductUnitType;

/**
 * ProductUnit controller.
 *
 *
 */
class ProductUnitController extends Controller
{

    /**
     * Lists all ProductUnit entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UerpProductBundle:ProductUnit')->findAll();

        return $this->render('UerpProductBundle:ProductUnit:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new ProductUnit entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ProductUnit();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('product_unit_show', array('id' => $entity->getId())));
        }

        return $this->render('UerpProductBundle:ProductUnit:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ProductUnit entity.
     *
     * @param ProductUnit $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ProductUnit $entity)
    {
        $form = $this->createForm(new ProductUnitType(), $entity, array(
            'action' => $this->generateUrl('product_unit_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ProductUnit entity.
     *
     */
    public function newAction()
    {
        $entity = new ProductUnit();
        $form   = $this->createCreateForm($entity);

        return $this->render('UerpProductBundle:ProductUnit:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProductUnit entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpProductBundle:ProductUnit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductUnit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UerpProductBundle:ProductUnit:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProductUnit entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpProductBundle:ProductUnit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductUnit entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UerpProductBundle:ProductUnit:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ProductUnit entity.
    *
    * @param ProductUnit $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProductUnit $entity)
    {
        $form = $this->createForm(new ProductUnitType(), $entity, array(
            'action' => $this->generateUrl('product_unit_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ProductUnit entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpProductBundle:ProductUnit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductUnit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('product_unit_edit', array('id' => $id)));
        }

        return $this->render('UerpProductBundle:ProductUnit:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ProductUnit entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UerpProductBundle:ProductUnit')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductUnit entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('product_unit'));
    }

    /**
     * Creates a form to delete a ProductUnit entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_unit_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
