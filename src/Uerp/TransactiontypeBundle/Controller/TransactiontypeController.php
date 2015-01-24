<?php

namespace Uerp\TransactiontypeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Uerp\TransactiontypeBundle\Entity\Transactiontype;
use Uerp\TransactiontypeBundle\Form\TransactiontypeType;

/**
 * Transactiontype controller.
 *
 * @Route("/transactiontype")
 */
class TransactiontypeController extends Controller
{

    /**
     * Lists all Transactiontype entities.
     *
     * @Route("/", name="transactiontype")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UerpTransactiontypeBundle:Transactiontype')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Transactiontype entity.
     *
     * @Route("/", name="transactiontype_create")
     * @Method("POST")
     * @Template("UerpTransactiontypeBundle:Transactiontype:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Transactiontype();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('transactiontype_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Transactiontype entity.
     *
     * @param Transactiontype $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Transactiontype $entity)
    {
        $form = $this->createForm(new TransactiontypeType(), $entity, array(
            'action' => $this->generateUrl('transactiontype_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Transactiontype entity.
     *
     * @Route("/new", name="transactiontype_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Transactiontype();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Transactiontype entity.
     *
     * @Route("/{id}", name="transactiontype_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpTransactiontypeBundle:Transactiontype')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Transactiontype entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Transactiontype entity.
     *
     * @Route("/{id}/edit", name="transactiontype_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpTransactiontypeBundle:Transactiontype')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Transactiontype entity.');
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
    * Creates a form to edit a Transactiontype entity.
    *
    * @param Transactiontype $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Transactiontype $entity)
    {
        $form = $this->createForm(new TransactiontypeType(), $entity, array(
            'action' => $this->generateUrl('transactiontype_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Transactiontype entity.
     *
     * @Route("/{id}", name="transactiontype_update")
     * @Method("PUT")
     * @Template("UerpTransactiontypeBundle:Transactiontype:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpTransactiontypeBundle:Transactiontype')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Transactiontype entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('transactiontype_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Transactiontype entity.
     *
     * @Route("/{id}", name="transactiontype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UerpTransactiontypeBundle:Transactiontype')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Transactiontype entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('transactiontype'));
    }

    /**
     * Creates a form to delete a Transactiontype entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('transactiontype_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
