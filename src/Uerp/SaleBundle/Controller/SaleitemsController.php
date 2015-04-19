<?php

namespace Uerp\SaleBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Uerp\SaleBundle\Entity\Saleitems;
use Symfony\Component\HttpFoundation\Response;
use Uerp\SaleBundle\Form\SaleitemsType;

/**
 * Saleitems controller.
 *
 * @Route("/saleitems")
 */
class SaleitemsController extends Controller
{

    /**
     * Creates a new Saleitems entity.
     *
     * @Route("/additem", name="saleitems_additem")
     * @Method("POST")
     * 
     */
    public function additemAction(Request $request)
    {

        $saleitems = New Saleitems();
        $em = $this->getDoctrine()->getManager();

        $saleid = $this->get('request')->request->get('saleid');
        $cod = $this->get('request')->request->get('cod');
        $price = $this->get('request')->request->get('price');
        $cprice = $this->get('request')->request->get('cprice');
        $qtd = $this->get('request')->request->get('qtd');

        $product  = $em->getRepository('UerpProductBundle:Product')->find($cod);

        $saleitems->setSaleId($saleid);
        $saleitems->setProductId($cod);
        $saleitems->setProduct($product);
        $saleitems->setQtd($qtd);
        $saleitems->setProdcost($cprice);
        $saleitems->setProdprice($price);
        $sc = $qtd * $cprice;
        $sv = $qtd * $price;
        $saleitems->setSubtotalcost($sc);
        $saleitems->setSubtotalsale($sv);
        $saleitems->setItenaux('aux');        

        $em->persist($saleitems);
        $entity = $em->getRepository('UerpSaleBundle:Sale')->find($saleid);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $tc = $entity->getTotalcost() + $sc;
        $tv = $entity->getTotalsale() + $sv;
        $ti = $entity->getNitems() + $qtd;

        $entity->setTotalcost($tc);
        $entity->setTotalsale($tv);
        $entity->setNitems($ti);

        $em->flush(); 
        $response = new Response();
        $response->setContent(json_encode(array(
            'id' => $saleitems->getId(),
        )));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
}

    /**
     * Creates a new Saleitems entity.
     *
     * @Route("/removeitem", name="saleitems_remove")
     * @Method("POST")
     * 
     */
    public function removeAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $itemid = $this->get('request')->request->get('itemid');

        $item  = $em->getRepository('UerpSaleBundle:Saleitems')->find($itemid);

        $saleid= $item->getSaleid();
        $qtd = $item->getQtd();
        $sc = $item->getSubtotalcost();
        $sv = $item->getSubtotalsale();
        
        $em->remove($item);
        $em->flush();

        $entity = $em->getRepository('UerpSaleBundle:Sale')->find($saleid);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $tc = $entity->getTotalcost() - $sc;
        $tv = $entity->getTotalsale() - $sv;
        $ti = $entity->getNitems() - $qtd;

        $entity->setTotalcost($tc);
        $entity->setTotalsale($tv);
        $entity->setNitems($ti);

        $em->flush(); 
        $response = new Response();
        $response->setContent(json_encode(array(
            'id' => 'produto apagado',
        )));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
}








    /**
     * Lists all Saleitems entities.
     *
     * @Route("/", name="saleitems")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UerpSaleBundle:Saleitems')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all Saleitems from the sale id entities.
     *
     * @Route("/listitems", name="listsaleitems")
     * @Method("POST")
     * 
     */
    public function listsaleitemsAction(Request $request)
    {
        $id = $this->get('request')->request->get('id');
        $em = $this->getDoctrine()->getManager();


        $entity = $em->getRepository('UerpSaleBundle:Saleitems')->findBySaleid($id);

        // if (!$entity) {
        //     throw $this->createNotFoundException('Unable to find Sale entity.');
        // }
        // dump($entity); die();
        return $this->render(
            'UerpSaleBundle:Sale:saleitems.html.twig',
            array( 'entities'      => $entity,)
        );


    }






    /**
     * Creates a new Saleitems entity.
     *
     * @Route("/", name="saleitems_create")
     * @Method("POST")
     * @Template("UerpSaleBundle:Saleitems:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Saleitems();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('saleitems_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Saleitems entity.
     *
     * @param Saleitems $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Saleitems $entity)
    {
        $form = $this->createForm(new SaleitemsType(), $entity, array(
            'action' => $this->generateUrl('saleitems_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Saleitems entity.
     *
     * @Route("/new", name="saleitems_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Saleitems();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Saleitems entity.
     *
     * @Route("/{id}", name="saleitems_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpSaleBundle:Saleitems')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Saleitems entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Saleitems entity.
     *
     * @Route("/{id}/edit", name="saleitems_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpSaleBundle:Saleitems')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Saleitems entity.');
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
    * Creates a form to edit a Saleitems entity.
    *
    * @param Saleitems $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Saleitems $entity)
    {
        $form = $this->createForm(new SaleitemsType(), $entity, array(
            'action' => $this->generateUrl('saleitems_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Saleitems entity.
     *
     * @Route("/{id}", name="saleitems_update")
     * @Method("PUT")
     * @Template("UerpSaleBundle:Saleitems:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpSaleBundle:Saleitems')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Saleitems entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('saleitems_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Saleitems entity.
     *
     * @Route("/{id}", name="saleitems_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UerpSaleBundle:Saleitems')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Saleitems entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('saleitems'));
    }

    /**
     * Creates a form to delete a Saleitems entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('saleitems_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
