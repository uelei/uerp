<?php

namespace Uerp\ProductBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Uerp\ProductBundle\Entity\ProductIcms;
use Uerp\ProductBundle\Form\ProductIcmsType;

/**
 * ProductIcms controller.
 *
 *
 */
class ProductIcmsController extends Controller
{

    /**
     * Lists all ProductIcms entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UerpProductBundle:ProductIcms')->findAll();

        return $this->render('UerpProductBundle:ProductIcms:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new ProductIcms entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new ProductIcms();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('product_icms_show', array('id' => $entity->getId())));
        }

        return $this->render('UerpProductBundle:ProductIcms:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a ProductIcms entity.
     *
     * @param ProductIcms $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ProductIcms $entity)
    {
        $form = $this->createForm(new ProductIcmsType(), $entity, array(
            'action' => $this->generateUrl('product_icms_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ProductIcms entity.
     *
     */
    public function newAction()
    {
        $entity = new ProductIcms();
        $form   = $this->createCreateForm($entity);

        return $this->render('UerpProductBundle:ProductIcms:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ProductIcms entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpProductBundle:ProductIcms')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductIcms entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UerpProductBundle:ProductIcms:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ProductIcms entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpProductBundle:ProductIcms')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductIcms entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('UerpProductBundle:ProductIcms:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a ProductIcms entity.
    *
    * @param ProductIcms $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProductIcms $entity)
    {
        $form = $this->createForm(new ProductIcmsType(), $entity, array(
            'action' => $this->generateUrl('product_icms_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ProductIcms entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpProductBundle:ProductIcms')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductIcms entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('product_icms_edit', array('id' => $id)));
        }

        return $this->render('UerpProductBundle:ProductIcms:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a ProductIcms entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UerpProductBundle:ProductIcms')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductIcms entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('product_icms'));
    }

    /**
     * Creates a form to delete a ProductIcms entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_icms_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
