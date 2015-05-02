<?php

namespace Uerp\ReportBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Uerp\SaleBundle\Entity\Sale;

class SalesreportController extends Controller
{
  /**
   * Report of the day.
   *
   * @Route("/", name="report")
   * @Method("GET")
   * @Template()
   */
  public function indexAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $entities = $em->getRepository('UerpStatusBundle:Status')->findAll();

    return array(
        'entities' => $entities,
    );


  }





}
