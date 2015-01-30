<?php

namespace Uerp\SubcategoriesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Uerp\SubcategoriesBundle\Entity\Subcategories;
use Uerp\SubcategoriesBundle\Form\SubcategoriesType;

/**
 * Subcategories controller.
 *
 * @Route("/subcategories")
 */
class SubcategoriesController extends Controller
{

    /**
     * Lists all Subcategories entities.
     *
     * @Route("/", name="subcategories")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UerpSubcategoriesBundle:Subcategories')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Subcategories entity.
     *
     * @Route("/", name="subcategories_create")
     * @Method("POST")
     * @Template("UerpSubcategoriesBundle:Subcategories:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Subcategories();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('subcategories_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Subcategories entity.
     *
     * @param Subcategories $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Subcategories $entity)
    {
        $form = $this->createForm(new SubcategoriesType(), $entity, array(
            'action' => $this->generateUrl('subcategories_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Subcategories entity.
     *
     * @Route("/new", name="subcategories_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Subcategories();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Subcategories entity.
     *
     * @Route("/{id}", name="subcategories_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpSubcategoriesBundle:Subcategories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Subcategories entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Subcategories entity.
     *
     * @Route("/{id}/edit", name="subcategories_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpSubcategoriesBundle:Subcategories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Subcategories entity.');
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
    * Creates a form to edit a Subcategories entity.
    *
    * @param Subcategories $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Subcategories $entity)
    {
        $form = $this->createForm(new SubcategoriesType(), $entity, array(
            'action' => $this->generateUrl('subcategories_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Subcategories entity.
     *
     * @Route("/{id}", name="subcategories_update")
     * @Method("PUT")
     * @Template("UerpSubcategoriesBundle:Subcategories:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpSubcategoriesBundle:Subcategories')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Subcategories entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('subcategories_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Subcategories entity.
     *
     * @Route("/{id}", name="subcategories_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UerpSubcategoriesBundle:Subcategories')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Subcategories entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('subcategories'));
    }

    /**
     * Creates a form to delete a Subcategories entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('subcategories_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
