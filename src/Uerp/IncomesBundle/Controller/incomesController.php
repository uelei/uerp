<?php

namespace Uerp\IncomesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Uerp\IncomesBundle\Entity\incomes;
use Uerp\IncomesBundle\Form\incomesType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * incomes controller.
 *
 * @Route("/incomes")
 */
class incomesController extends Controller
{

  public function rec($id){

    $em = $this->getDoctrine()->getManager();
    $pgcod = $this->container->getParameter('cod.billpg');

    $entity = $em->getRepository('UerpIncomesBundle:incomes')->find($id);

    if (!$entity) {
        throw $this->createNotFoundException('Unable to find incomes entity.');
    }

    $entitya = $em->getRepository('UerpBankBundle:BankAccount')->find($entity->getBank()->getId());

    if (!$entitya) {
        throw $this->createNotFoundException('Unable to find bank entity.');
    }

    $income = $entity->getValuel();
    $balance = $entitya->getBalance() + $income;
    $status = $em->getReference('UerpStatusBundle:Status', $pgcod);
    $entity->setStatus($status);
    $entitya->setBalance($balance);
    $em->flush();
    return true;

  }




  /**
   * Displays a form to edit an existing incomes entity.
   *
   * @Route("/{id}/rec", name="incomes_rec")
   * @Method("GET")
   * @Template()
   */
  public function recAction(Request $request,$id)
  {



      // dump($entity);
    // die();

      // if($entity->getAccount() == NULL ){ echo "erro";}
      // if($entity->getStatus() == ){ echo "erro";
      //
      //
      // }

if($this->rec($id)){
      // $deleteForm = $this->createDeleteForm($id);
      return $this->redirect($this->generateUrl('incomes'));

      // return array(
      //     'entity'      => $entity,
      //     'edit_form'   => $editForm->createView(),
      //     'delete_form' => $deleteForm->createView(),
      // );
  }

  }











  /**
   * Displays a form to edit an existing incomes entity.
   *
   * @Route("/recselect/", name="incomes_recselect")
   * @Method("POST")
   * @Template()
   */
   public function recselectAction(Request $request)
  {
   $pgcod = $this->container->getParameter('cod.billpg');
  // //  $form->handleRequest($request);

  $datai=  $request->get('datai');
  $dataf=  $request->get('dataf');

  $em = $this->getDoctrine()->getManager();
     $query = $em->createQuery(
     'SELECT b FROM UerpIncomesBundle:incomes b WHERE
     b.date > ?1 AND b.date < ?2 AND b.status != ?4  OR  b.date = ?3 AND b.status != ?4 ')
     ->setParameters( array(1=> $datai,2=>$dataf,3=>$datai,4=>$pgcod));


     $entities = $query->getResult();

     foreach ($entities as $income){


        $this->rec($income->getId());

     }

     return $this->redirect($this->generateUrl('incomes'));


  }




































  /**
   * Displays a form to edit an existing incomes entity.
   *
   * @Route("/filterp/", name="incomes_filterp")
   * @Method("POST")
   * @Template()
   */
   public function filterpAction(Request $request)
 {
   $pgcod = $this->container->getParameter('cod.billpg');
  //  $form->handleRequest($request);
$forr=  $request->request->get('form');
// $datai =  $this->get('request')->request->get('datai');
// dump($datai['datai']);
$datai= $forr["datai"];
$dataf= $forr["dataf"];

$form =  $this->createDatefilterForm($datai,$dataf);

     $form->handleRequest($request);

    //  if ($form->isValid()) {
    //      // perform some action, such as saving the task to the database
     //
    //      // return $this->redirect($this->generateUrl('filter/',array('datai' => $form->getdatai(),'dataf' => $form->getdataf()  )  ));
    //      return $this->forward('UerpIncomesBundle:incomes:incomes_filterp', array(
    //          'datai'  => $form["datai"]->getData(),
    //          'dataf' => $form["dataf"]->getData(),
    //      ));
    //  }

     $em = $this->getDoctrine()->getManager();
     $query = $em->createQuery(
     'SELECT b FROM UerpIncomesBundle:incomes b WHERE

     b.date > ?1 AND b.date < ?2 AND b.status != ?4  OR  b.date = ?3 AND b.status != ?4 ')

     ->setParameters( array(1=> $datai,2=>$dataf,3=>$datai,4=>$pgcod));


     $entities = $query->getResult();

return $this->render('UerpIncomesBundle:incomes:filter.html.twig',array ('formfilter' => $form->createView(),'entities' => $entities,));

 }




   /**
     * @Route("/delincome",name= "delincome")
     * @Method("POST")
     * @Template()
     * */
public function delincomeAction(Request $request)
{
    $billpg = $this->container->getParameter('cod.billpg');//4
    $em = $this->getDoctrine()->getManager();
    $icomeid = $this->get('request')->request->get('id');

    // $income = $em->getRepository('UerpIncomesBundle:incomes')->find($id);
    $entity = $em->getRepository('UerpIncomesBundle:incomes')->find($icomeid);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find incomes entity.');
        }

        if($entity->getStatus()->getId() == $billpg ){

            $entitya = $em->getRepository('UerpBankBundle:BankAccount')->find($entity->getBank());

            if (!$entitya) {
                throw $this->createNotFoundException('Unable to find account entity.');
            }

            $balance = $entitya->getBalance() - $entity->getValuel();
            $entitya->setBalance($balance);

        }

        $em->remove($entity);
        $em->flush();


  $response = new Response();
        $response->setContent(json_encode(array(
            'id' => 'ok',
        )));
        $response->headers->set('Content-Type', 'application/json');

        return $response;


}


    /**
     * @Route("/addincome",name= "addincome")
     * @Method("POST")
     * @Template()
     * */


public function addincomeAction(Request $request)
{


        $billpg = $this->container->getParameter('cod.billpg');//4

        $em = $this->getDoctrine()->getManager();

        $saleid = $this->get('request')->request->get('saleid');
        $value = $this->get('request')->request->get('value');
        $parc = $this->get('request')->request->get('parc');
        $tpay = $this->get('request')->request->get('tpay');
        $date = $this->get('request')->request->get('date');
        $dat = new \DateTime($date);
        $dat->setTime(date("H"),date("i"));

        $tpayment  = $em->getRepository('UerptpaymentBundle:tpayment')->find($tpay);

        $valueb = $value/$parc;

        $tax = $tpayment->getTax() * $valueb /100  ;

        $valuel = $valueb - $tax;

        $status = $tpayment->getDefaultstatus();

        $idays = $tpayment->getDays();
        // $dat->modify("+".$idays." days");
        $entitya = $em->getRepository('UerpBankBundle:BankAccount')->find($tpayment->getBank());

            if (!$entitya) {
                throw $this->createNotFoundException('Unable to find account entity.');
            }
        $bal = 0.0;

        for ($i=0 ; $i < $parc  ; $i++ ) {

          $datd = new \DateTime($date);
          $datd->setTime(date("H"),date("i"));


          $p = $i+1;

          $addday = $idays*$p;
          $datd->modify("+".$addday." days");

// dump($da); die;



          $incomes = New incomes();
          $incomes->setSaleId($saleid);
          $incomes->setValueb($valueb);
          $incomes->setValuel($valuel);
          $bal = $bal + $valuel;
          $incomes->setTax($tax);
          $incomes->setBank($entitya);
          $incomes->setDate($datd);
          $incomes->setParc($p."/".$parc);
          $incomes->setStatus($status);
          $incomes->setTpayment($tpayment);

          $em->persist($incomes);

        }

        if($status->getId() == $billpg ){
            $balance = $entitya->getBalance() + $bal;
            $entitya->setBalance($balance);

        }




        $em->flush();


        $response = new Response();
        $response->setContent(json_encode(array(
            'id' => $incomes->getId(),
        )));
        $response->headers->set('Content-Type', 'application/json');

        return $response;

}

    /**
     * Lists all Saleitems from the sale id entities.
     *
     * @Route("/listsalesincomes", name="listsalesincomes")
     * @Method("POST")
     *
     */
    public function listsaleincomesAction(Request $request)
    {
        $id = $this->get('request')->request->get('saleid');
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpIncomesBundle:incomes')->findBySaleid($id);

        // if (!$entity) {
        //     throw $this->createNotFoundException('Unable to find Sale entity.');
        // }
        // dump($entity); die();
        return $this->render(
            'UerpIncomesBundle:incomes:saleincomes.html.twig',
            array( 'entities'      => $entity,)
        );


    }


    /**
     * Lists all incomes entities.
     *
     * @Route("/", name="incomes")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $pgcod = $this->container->getParameter('cod.billpg');
        $datenow = date("Y-m-d");
        $form =  $this->createDatefilterForm($datenow,$datenow);

           $em = $this->getDoctrine()->getManager();
           $query = $em->createQuery('SELECT b FROM UerpIncomesBundle:incomes b WHERE b.date > ?1 AND b.date < ?2 OR b.date = ?3  AND b.status != ?4  ')->setParameters( array(1=> $datenow,2=>$datenow,3=>$datenow,4=>$pgcod));
           $entities = $query->getResult();

     return $this->render('UerpIncomesBundle:incomes:filter.html.twig',array ('formfilter' => $form->createView(),'entities' => $entities,));
        // $em = $this->getDoctrine()->getManager();
        //
        // $entities = $em->getRepository('UerpIncomesBundle:incomes')->findAll();
        //
        // return array(
        //     'entities' => $entities,
        // );
    }


    /**
     * Creates a new incomes entity.
     *
     * @Route("/", name="incomes_create")
     * @Method("POST")
     * @Template("UerpIncomesBundle:incomes:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new incomes();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('incomes_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }


    /**
     * Creates a form to create a incomes entity.
     *
     * @param incomes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(incomes $entity)
    {
        $form = $this->createForm(new incomesType(), $entity, array(
            'action' => $this->generateUrl('incomes_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }


    /**
     * Displays a form to create a new incomes entity.
     *
     * @Route("/new", name="incomes_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new incomes();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }


    /**
     * Finds and displays a incomes entity.
     *
     * @Route("/{id}", name="incomes_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpIncomesBundle:incomes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find incomes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }


    /**
     * Displays a form to edit an existing incomes entity.
     *
     * @Route("/{id}/edit", name="incomes_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpIncomesBundle:incomes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find incomes entity.');
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
    * Creates a form to edit a incomes entity.
    *
    * @param incomes $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(incomes $entity)
    {
        $form = $this->createForm(new incomesType(), $entity, array(
            'action' => $this->generateUrl('incomes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }


    /**
     * Edits an existing incomes entity.
     *
     * @Route("/{id}", name="incomes_update")
     * @Method("PUT")
     * @Template("UerpIncomesBundle:incomes:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UerpIncomesBundle:incomes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find incomes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('incomes_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a incomes entity.
     *
     * @Route("/{id}", name="incomes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UerpIncomesBundle:incomes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find incomes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('incomes'));
    }

    /**
     * Creates a form to delete a incomes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('incomes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
     * Creates a form to date filter.
     *
     * @param mixed $datei and $datef
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDatefilterForm($datei,$datef)
    {
      return  $this->createFormBuilder()
                      ->setMethod('POST')
                      ->setAction($this->generateUrl('incomes_filterp'))
                      ->add('datai','date', array('input'  => 'datetime',
                        'widget' => 'single_text','data' => new \DateTime($datei)))
                      ->add('dataf','date', array('input'  => 'datetime',
                         'widget' => 'single_text','data' => new \DateTime($datef)))
                      ->add('Filter','submit')
                      ->getForm();
    }

}
