<?php

namespace Uerp\tpaymentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Uerp\tpaymentBundle\Entity\tpayment;
use Uerp\tpaymentBundle\Form\tpaymentType;

/**
 * tpayment controller.
 *
 * @Route("/tpayment")
 */
class tpaymentController extends Controller
{

    /**
     * Lists all tpayment entities.
     *
     * @Route("/", name="tpayment")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UerptpaymentBundle:tpayment')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new tpayment entity.
     *
     * @Route("/", name="tpayment_create")
     * @Method("POST")
     * @Template("UerptpaymentBundle:tpayment:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new tpayment();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tpayment_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a tpayment entity.
     *
     * @param tpayment $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(tpayment $entity)
    {
        $form = $this->createForm(new tpaymentType(), $entity, array(
            'action' => $this->generateUrl('tpayment_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new tpayment entity.
     *
     * @Route("/new", name="tpayment_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new tpayment();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a tpayment entity.
     *
     * @Route("/{id}", name="tpayment_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerptpaymentBundle:tpayment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find tpayment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing tpayment entity.
     *
     * @Route("/{id}/edit", name="tpayment_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerptpaymentBundle:tpayment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find tpayment entity.');
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
    * Creates a form to edit a tpayment entity.
    *
    * @param tpayment $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(tpayment $entity)
    {
        $form = $this->createForm(new tpaymentType(), $entity, array(
            'action' => $this->generateUrl('tpayment_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing tpayment entity.
     *
     * @Route("/{id}", name="tpayment_update")
     * @Method("PUT")
     * @Template("UerptpaymentBundle:tpayment:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerptpaymentBundle:tpayment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find tpayment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tpayment_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a tpayment entity.
     *
     * @Route("/{id}", name="tpayment_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UerptpaymentBundle:tpayment')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find tpayment entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tpayment'));
    }

    /**
     * Creates a form to delete a tpayment entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tpayment_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
