<?php

namespace Uerp\BankBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Uerp\BankBundle\Entity\BankAccount;
use Uerp\BankBundle\Form\BankAccountType;

/**
 * BankAccount controller.
 *
 * @Route("/bankaccount")
 */
class BankAccountController extends Controller
{

    /**
     * Lists all BankAccount entities.
     *
     * @Route("/", name="bankaccount")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UerpBankBundle:BankAccount')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new BankAccount entity.
     *
     * @Route("/", name="bankaccount_create")
     * @Method("POST")
     * @Template("UerpBankBundle:BankAccount:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new BankAccount();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('bankaccount_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a BankAccount entity.
     *
     * @param BankAccount $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(BankAccount $entity)
    {
        $form = $this->createForm(new BankAccountType(), $entity, array(
            'action' => $this->generateUrl('bankaccount_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new BankAccount entity.
     *
     * @Route("/new", name="bankaccount_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new BankAccount();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a BankAccount entity.
     *
     * @Route("/{id}", name="bankaccount_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpBankBundle:BankAccount')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BankAccount entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing BankAccount entity.
     *
     * @Route("/{id}/edit", name="bankaccount_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpBankBundle:BankAccount')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BankAccount entity.');
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
    * Creates a form to edit a BankAccount entity.
    *
    * @param BankAccount $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(BankAccount $entity)
    {
        $form = $this->createForm(new BankAccountType(), $entity, array(
            'action' => $this->generateUrl('bankaccount_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing BankAccount entity.
     *
     * @Route("/{id}", name="bankaccount_update")
     * @Method("PUT")
     * @Template("UerpBankBundle:BankAccount:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpBankBundle:BankAccount')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BankAccount entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('bankaccount_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a BankAccount entity.
     *
     * @Route("/{id}", name="bankaccount_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UerpBankBundle:BankAccount')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BankAccount entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('bankaccount'));
    }

    /**
     * Creates a form to delete a BankAccount entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bankaccount_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete','attr' => array( 'class' => 'btn btn-lg btn-default') ))
            ->getForm()
        ;
    }
}
