<?php

namespace Uerp\SaleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Uerp\SaleBundle\Entity\Sale;
use Uerp\SaleBundle\Form\SaleType;

/**
 * Sale controller.
 *
 * @Route("/sale")
 */
class SaleController extends Controller
{

    /**
     * Lists all Sale entities.
     *
     * @Route("/", name="sale")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UerpSaleBundle:Sale')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Sale entity.
     *
     * @Route("/", name="sale_create")
     * @Method("POST")
     * @Template("UerpSaleBundle:Sale:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Sale();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('sale_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Sale entity.
     *
     * @param Sale $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Sale $entity)
    {
        $form = $this->createForm(new SaleType(), $entity, array(
            'action' => $this->generateUrl('sale_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Sale entity.
     *
     * @Route("/new", name="sale_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Sale();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Sale entity.
     *
     * @Route("/{id}", name="sale_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpSaleBundle:Sale')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sale entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Sale entity.
     *
     * @Route("/{id}/edit", name="sale_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpSaleBundle:Sale')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sale entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Sale entity.
    *
    * @param Sale $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Sale $entity)
    {
        $form = $this->createForm(new SaleType(), $entity, array(
            'action' => $this->generateUrl('sale_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Sale entity.
     *
     * @Route("/{id}", name="sale_update")
     * @Method("PUT")
     * @Template("UerpSaleBundle:Sale:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpSaleBundle:Sale')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Sale entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('sale_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Sale entity.
     *
     * @Route("/{id}", name="sale_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UerpSaleBundle:Sale')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Sale entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('sale'));
    }

    /**
     * Creates a form to delete a Sale entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sale_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
