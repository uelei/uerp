<?php

namespace Uerp\BillsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Uerp\BillsBundle\Entity\Bills;
use Uerp\BillsBundle\Form\BillsType;
use Uerp\SubcategoriesBundle\Entity\Subcategories;

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
    public function indexAction(Request $request)
    {
                $datea = new \Datetime('now');

        $form = $this->createFormBuilder()
                ->setMethod('GET')
                ->setAction($this->generateUrl('bills'))
                ->add('datai','date', array(
                    'input'  => 'datetime',
                    'widget' => 'single_text',
                    'data' => $datea
                    ))
                ->add('dataf','date', array(
                    'input'  => 'datetime',
                   'widget' => 'single_text',
                    'data' => $datea

                    ))
                ->add('Filter','submit')
                ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
         return $this->redirect($this->generateUrl('filter', array(
            'datai'  => $form["datai"]->getData()->format("Y-m-d"),
            'dataf' => $form["dataf"]->getData()->format("Y-m-d"),
              )));
        }

        $d = $datea->format('Y-m-d');

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT b FROM UerpBillsBundle:Bills b WHERE b.date >= ?1 AND b.date <= ?2  OR b.date = ?3 ORDER BY b.date')->setParameters( array(1=> $d,2=>$d,3=>$d));
        $entities = $query->getResult();

        return $this->render('UerpBillsBundle:Bills:index.html.twig',array ('formfilter' => $form->createView(),'entities' => $entities,));

    }

/**
 * @Route("/listsubcategories", name="_listsubcategories")
 * @Method("GET")
 */
public function getbycategoriesAction()
{

    // print_r($data); die();

    $this->em = $this->getDoctrine()->getEntityManager();
    $this->repository = $this->em->getRepository('UerpSubcategoriesBundle:Subcategories');

    $categories = $this->get('request')->query->get('data');

    $subcategories = $this->repository->findByCategories($categories);

    $html = '';
    $html = $html . sprintf("<option value=\"%d\">%s</option>",Null, 'Selecione');
    foreach($subcategories as $locality)
    {
        $html = $html . sprintf("<option value=\"%d\">%s</option>",$locality->getId(), $locality->getName());
    }

    return new Response($html);
}



  /**
     * Lists all Bills entities.
     *
     * @Route("/filter/{datai}/{dataf}", name="filter")
     * @Method("GET")
     * @Template("UerpBillsBundle:Bills:index.html.twig")
     */
    public function filterAction($datai,$dataf,Request $request)
    {

   $form = $this->createFormBuilder()
                ->setMethod('GET')
                ->setAction($this->generateUrl('bills'))
                ->add('datai','date', array(
                    'input'  => 'datetime',
                    'widget' => 'single_text',
                    // 'format' => 'yyyy-M-dd',
                    'data' => new \DateTime($datai)
                    ))
                ->add('dataf','date', array(
                    'input'  => 'datetime',
                    'widget' => 'single_text',
                    // 'format' => 'yyyy-M-dd',
                    'data' => new \DateTime($dataf)
                    ))
                ->add('Filter','submit')
                ->getForm();

        // $form->handleRequest($request);
        //
        // if ($form->isValid()) {
        //     // perform some action, such as saving the task to the database
        //
        //     // return $this->redirect($this->generateUrl('filter/',array('datai' => $form->getdatai(),'dataf' => $form->getdataf()  )  ));
        //     return $this->forward('UerpBillsBundle:Bills:filter', array(
        //         'datai'  => $form["datai"]->getData(),
        //         'dataf' => $form["dataf"]->getData(),
        //     ));
        // }

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT b FROM UerpBillsBundle:Bills b WHERE b.date >= ?1 AND b.date <= ?2  OR b.date = ?3 ORDER BY b.date')->setParameters( array(1=> $datai,2=>$dataf,3=>$datai));
        $entities = $query->getResult();

  return $this->render('UerpBillsBundle:Bills:index.html.twig',array ('formfilter' => $form->createView(),'entities' => $entities,));

    }



    /**
     * Lists all Bills entities.
     *
     * @Route("/all", name="all_bills")
     * @Method("GET")
     * @Template()
     */
    public function allAction()
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

        $form->add('submit', 'submit', array('label' => 'Create','attr' => array('class'=>'btn btn-lg btn-primary')));

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


        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),

        );
    }


    /**
     * Displays a form to edit an existing Bills entity.
     *
     * @Route("/{id}/pay", name="bills_pay")
     * @Method("PUT")
     * @Template("UerpMainBundle::main.html.twig")
     */
    public function payAction(Request $request,$id)
    {


// $f["datai"]->getData()->format("Y-m-d");




        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('UerpBillsBundle:Bills')->find($id);


        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);



        // $content = $request->getContent();
        // $F->handleRequest($request);


// $f["datai"]->getData()->format("Y-m-d");

    // print_r($x); die();







if($entity->getAccount() == NULL ){
echo "erro ";

}


        $entitya = $em->getRepository('UerpBankBundle:BankAccount')->find($entity->getAccount()->getId());


// print_r($entity->getValue()); die();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bills entity.');
        }
        if (!$entitya) {
            throw $this->createNotFoundException('Unable to find account entity.');
        }




        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);


        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('bills_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),

        );




        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpBillsBundle:Bills')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bills entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),

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

        $form->add('Update', 'submit', array('label' => 'Update','attr' => array('class'=>'btn btn-lg btn-success')))->add('Pay','submit',array('attr' => array('class'=>'btn btn-lg btn-primary')))
            ->add('Delete','submit',array('attr' => array('class'=>'btn btn-lg btn-danger')));
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
        //set defaul value for status
        $pgcod = $this->container->getParameter('cod.billpg');
        // $pgcod = 4;

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('UerpBillsBundle:Bills')->find($id);


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bills entity.');
        }


        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

          // dump($editForm); die;
           // print_r($editForm['categories']->getData()->getId()); die();

            if($editForm->get('Pay')->isClicked()){//pay

                if($editForm['account']->getData() == NULL){

                    $editForm->get('account')->addError(new FormError('Não Selecionado !! '));
                    return array(
                        'entity'      => $entity,
                        'edit_form'   => $editForm->createView(),

                    );

                }else{

                    $entitya = $em->getRepository('UerpBankBundle:BankAccount')->find($entity->getAccount()->getId());

                    if (!$entitya) {
                        throw $this->createNotFoundException('Unable to find account entity.');
                    }

                    $duppg = $entity->getValue() * -1;
                    $balance = $entitya->getBalance() + $duppg;
                    $status = $em->getReference('UerpStatusBundle:Status', $pgcod);
                    $entity->setStatus($status);
                    $entity->setValue($duppg);
                    $entitya->setBalance($balance);

                    $em->flush();

                    return $this->redirect($this->generateUrl('bills_edit', array('id' => $id)));

                }

            }//pay-end
            if($editForm->get('Delete')->isClicked()){//delete
                // echo "detete";
                 $pgcod = $this->container->getParameter('cod.billpg');//4
                if($editForm['status']->getData()->getId() == $pgcod ){

                    $entitya = $em->getRepository('UerpBankBundle:BankAccount')->find($entity->getAccount()->getId());

                    if (!$entitya) {
                        throw $this->createNotFoundException('Unable to find account entity.');
                    }

                    $duppg = $entity->getValue() * -1;
                    $balance = $entitya->getBalance() + $duppg;
                    $entitya->setBalance($balance);

                }

                $em->remove($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('bills'));

            }//delete
            if($editForm->get('Update')->isClicked()){
              $em->flush();
              return $this->redirect($this->generateUrl('bills', array('id' => $id)));

            }


        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),

        );
    }

    /**
     * Deletes a Bills entity.
     *
     * @Route("/delete/{id}", name="bills_del")
     * @Method("GET")
     */
    public function delAction($id)
    {

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UerpBillsBundle:Bills')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Bills entity.');
            }
                $pgcod = $this->container->getParameter('cod.billpg');//4
                if($entity->getStatus()->getId() == $pgcod ){

                    $entitya = $em->getRepository('UerpBankBundle:BankAccount')->find($entity->getAccount()->getId());

                    if (!$entitya) {
                        throw $this->createNotFoundException('Unable to find account entity.');
                    }

                    $duppg = $entity->getValue() * -1;
                    $balance = $entitya->getBalance() + $duppg;
                    $entitya->setBalance($balance);
                }
            $em->remove($entity);
            $em->flush();


        return $this->redirect($this->generateUrl('bills'));
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
                 $pgcod = $this->container->getParameter('cod.billpg');//4
                if($entity->getStatus()->getId() == $pgcod ){

                    $entitya = $em->getRepository('UerpBankBundle:BankAccount')->find($entity->getAccount()->getId());

                    if (!$entitya) {
                        throw $this->createNotFoundException('Unable to find account entity.');
                    }

                    $duppg = $entity->getValue() * -1;
                    $balance = $entitya->getBalance() + $duppg;
                    $entitya->setBalance($balance);
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
