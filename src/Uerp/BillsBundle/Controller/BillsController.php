<?php

namespace Uerp\BillsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Uerp\BillsBundle\Entity\Bills;
use Uerp\BillsBundle\Form\BillsType;

/**
 * Bills controller.
 *
 * @Route("/bills")
 */
class BillsController extends Controller
{

    /**
     * Lists all Bills entities.
     *
     * @Route("/", name="bills")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UerpBillsBundle:Bills')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Bills entity.
     *
     * @Route("/", name="bills_create")
     * @Method("POST")
     * @Template("UerpBillsBundle:Bills:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Bills();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('bills_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Bills entity.
     *
     * @param Bills $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Bills $entity)
    {
        $form = $this->createForm(new BillsType(), $entity, array(
            'action' => $this->generateUrl('bills_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Bills entity.
     *
     * @Route("/new", name="bills_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Bills();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Bills entity.
     *
     * @Route("/{id}", name="bills_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpBillsBundle:Bills')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bills entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Bills entity.
     *
     * @Route("/{id}/edit", name="bills_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpBillsBundle:Bills')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bills entity.');
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
    * Creates a form to edit a Bills entity.
    *
    * @param Bills $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Bills $entity)
    {
        $form = $this->createForm(new BillsType(), $entity, array(
            'action' => $this->generateUrl('bills_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Bills entity.
     *
     * @Route("/{id}", name="bills_update")
     * @Method("PUT")
     * @Template("UerpBillsBundle:Bills:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpBillsBundle:Bills')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bills entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('bills_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Bills entity.
     *
     * @Route("/{id}", name="bills_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UerpBillsBundle:Bills')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Bills entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('bills'));
    }

    /**
     * Creates a form to delete a Bills entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bills_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
