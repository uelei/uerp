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
    public function indexAction(Request $request)
    {
// {'attr': {'class': 'task_field'}}
         // $filter = New filter();

         // $filter->setdatai(new \DateTime('now'));
         // $filter->setdataf(new \DateTime('now'));
                $datea = new \Datetime('now');

        $form = $this->createFormBuilder()
                ->setMethod('GET')
                ->setAction($this->generateUrl('bills'))
                ->add('datai','date', array(
                    'input'  => 'datetime',
                    'widget' => 'single_text',
                    // 'format' => 'dd/M/yyyy',
                    'data' => $datea
                    ))
                ->add('dataf','date', array(    
                    'input'  => 'datetime',
                   'widget' => 'single_text',
                    // 'widget' => 'choice',
                    // 'format' => 'dd/M/yyyy',
                    'data' => $datea
                  
                    ))
                ->add('Filter','submit')
                ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {


            // print_r($form["datai"]->getData()->format("Y-m-d")); die();
            // perform some action, such as saving the task to the database
                 return $this->redirect($this->generateUrl('filter', array(
                    'datai'  => $form["datai"]->getData()->format("Y-m-d"),
                    'dataf' => $form["dataf"]->getData()->format("Y-m-d"),


                    )));
            // return $this->redirect($this->generateUrl('filter/',array('datai' => $form->getdatai(),'dataf' => $form->getdataf()  )  ));
            // return $this->forward('UerpBillsBundle:Bills:filter', array(
            //     'datai'  => $form["datai"]->getData(),
            //     'dataf' => $form["dataf"]->getData(),
            // ));
        }


        $datai = new \Datetime('now');

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT b FROM UerpBillsBundle:Bills b ')->setMaxResults(10);
        $entities = $query->getResult();

        // return array(
        //     'entities' => $entities,
   
        // );
        return $this->render('UerpBillsBundle:Bills:index.html.twig',array ('formfilter' => $form->createView(),'entities' => $entities,));
   //          $datef = date('Y-m-d');
   // $response = $this->forward('UerpBillsBundle:Bills:filter', array(
   //      'datai'  => $datef,
   //      'dataf' => $datef,
   //  ));
   //  return $response;

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

        $form->handleRequest($request);

        if ($form->isValid()) {
            // perform some action, such as saving the task to the database

            // return $this->redirect($this->generateUrl('filter/',array('datai' => $form->getdatai(),'dataf' => $form->getdataf()  )  ));
            return $this->forward('UerpBillsBundle:Bills:filter', array(
                'datai'  => $form["datai"]->getData(),
                'dataf' => $form["dataf"]->getData(),
            ));
        }

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT b FROM UerpBillsBundle:Bills b WHERE b.date > ?1 AND b.date < ?2  OR b.date = ?3 ')->setParameters( array(1=> $datai,2=>$dataf,3=>$datai))->setMaxResults(10);
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



        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        $payForm = $this->createpayForm($id);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('bills_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );




        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpBillsBundle:Bills')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bills entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        $payForm = $this->createpayForm($id);

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

        // if (!$entitya) {
        //     throw $this->createNotFoundException('Unable to find account entity.');
        // }


        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            if($editForm->get('pay')->isClicked()){
                
                if($editForm['account']->getData() == NULL){
                    
                    $editForm->get('account')->addError(new FormError('Não Selecionado !! '));
                    return array(
                        'entity'      => $entity,
                        'edit_form'   => $editForm->createView(),
                        'delete_form' => $deleteForm->createView(),
                    );

                }else{

                    echo $entity->getAccount()->getId(); 
                    echo "<br>";
                    echo $editForm['Account']->getData()->getId();

                     // $entitya = $em->getRepository('UerpBankBundle:BankAccount')->find($entity->getAccount()->getId());


                    echo " contiua ";
                   
                }
            
            }
            echo "nao ";




            die();

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
