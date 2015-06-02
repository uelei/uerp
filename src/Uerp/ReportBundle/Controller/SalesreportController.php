<?php

namespace Uerp\ReportBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Uerp\SaleBundle\Entity\Sale;
use Ob\HighchartsBundle\Highcharts\Highchart;

/**
 * Salesreport controller.
 *
 * @Route("/report")
 */
class SalesreportController extends Controller
{

  /**
   * Report of the day.
   *
   * @Route("/", name="report")
   * @Method("GET")
   *
   */
  public function indexAction(Request $request)
  {
    $pgcod = $this->container->getParameter('cod.saleclose');
    $datenow = date("Y-m-d");
    $form =$this->createDatereportfilterForm($datenow);


    $chart = $this->daychart($datenow);
      $bar = $this->monthdaychart($datenow);

      return $this->render('UerpReportBundle:Salesreport:Salesreport.html.twig', array(
            'chart' => $chart,
          'barchart' => $bar,
          'formfilter'=> $form->createView(),
        ));

  }

  /**
   * Report of the day.
   *
   * @Route("/filterreport", name="report_filter")
   * @Method("POST")
   *
   */
  public function filterreportAction(Request $request)
  {
    $forr=  $request->request->get('form');
    $datenow = $forr["data"];
    $pgcod = $this->container->getParameter('cod.saleclose');

    $form =$this->createDatereportfilterForm($datenow);

    $chart = $this->monthdaychart($datenow);
      return $this->render('UerpReportBundle:Salesreport:Salesreport.html.twig', array(
            'chart' => $chart,'formfilter'=> $form->createView(),
        ));

  }



  /**
   * Creates a form to date filter.
   *
   * @param mixed $datei and $datef
   *
   * @return \Symfony\Component\Form\Form The form
   */
  private function createDatereportfilterForm($date)
  {
    return  $this->createFormBuilder()
                    ->setMethod('POST')
                    ->setAction($this->generateUrl('report_filter'))
                    ->add('data','date', array('input'  => 'datetime',
                      'widget' => 'single_text','data' => new \DateTime($date)))
                    ->add('Filter','submit')
                    ->getForm();
  }

  private function monthdaychart($date)
  {
    $d = explode("-", $date);
    $dat= $d[0]."-".$d[1];
    // dump($date); die;
    $pgcod = $this->container->getParameter('cod.saleclose');
    $repository = $this->getDoctrine()->getRepository('UerpSaleBundle:Sale');
    $query = $repository->createQueryBuilder('b')
      ->addselect('SUM(b.totalsale) as sumtotal' )
      ->where('b.date LIKE :datei AND b.status = :codpg ')
      ->setParameters(array('datei'=> $dat."%",'codpg'=> $pgcod))
      ->groupBy('b.date')
      ->getQuery();

      $ob = new Highchart();
      $ob->chart->renderTo('barcha');
      $ob->plotOptions->column(array(
          'dataLabels'    => array('enabled' => true,'rotation'=> -90 )
      ));
    $data = Array();
    $cat = Array();
    // $em = $this->getDoctrine()->getManager();
    $t = 0.0;
    $entities = $query->getResult();
    // dump($entities); die;
      foreach ($entities as $sale){

        // $entitya = $em->getRepository('UerpSellerBundle:Seller')->find($sale[0]->getseller()->getId());
        // $sellername = $entitya->getName();

        $t+=floatval($sale['sumtotal']);

        $data[] = array($sale[0]->getDate()->format('d'),floatval($sale['sumtotal']));

        $cat[] = $sale[0]->getDate()->format('d');
    }
    $ob->xAxis->categories($cat);
      $ob->title->text('Total das vendas por dia  R$ '.number_format($t,2,',',''));
      $ob->series(array(array('type' => 'column','name' => 'Day sales', 'data' => $data)));
    return $ob;
  }


  private function daychart($date)
  {

    $pgcod = $this->container->getParameter('cod.saleclose');
    $repository = $this->getDoctrine()->getRepository('UerpSaleBundle:Sale');
    $query = $repository->createQueryBuilder('b')
      ->addselect('SUM(b.totalsale) as sumtotal' )
      ->where('b.date >= :datei AND b.date <= :datef AND b.status = :codpg ')
      ->setParameters(array('datei'=> $date,'datef'=>$date,'codpg'=> $pgcod))
      ->groupBy('b.seller')
      ->getQuery();
      $ob = new Highchart();
      $ob->chart->renderTo('piechart');
      $ob->plotOptions->pie(array(
          'allowPointSelect'  => true,
          'cursor'    => 'pointer',
          'dataLabels'    => array('enabled' => true),
          'showInLegend'  => true
      ));
    $data = Array();
    $em = $this->getDoctrine()->getManager();
    $t = 0.0;

    $entities = $query->getResult();



      foreach ($entities as $sale){

        $entitya = $em->getRepository('UerpSellerBundle:Seller')->find($sale[0]->getseller()->getId());
        $sellername = $entitya->getName();
        $t+=floatval($sale['sumtotal']);

        $data[] = array($sellername,floatval($sale['sumtotal']));

      }
      $ob->title->text('Total das vendas do dia  R$ '.number_format($t,2,',',''));
      $ob->series(



      array(array('type' => 'pie','name' => 'Day sales', 'data' => $data)));
    return $ob;
  }




}
