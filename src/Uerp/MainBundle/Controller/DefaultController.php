<?php

namespace Uerp\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ob\HighchartsBundle\Highcharts\Highchart;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template("UerpMainBundle::main.html.twig")
     */
    public function indexAction()
    {

        $datenow = new \Datetime('now');
        $d = $datenow->format('Y-m-d');

        $datd = new \DateTime($d);
        $datd->modify("-3 days");




        $pgcod = $this->container->getParameter('cod.saleclose');

        $chart = $this->daychart($d);

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT b FROM UerpBillsBundle:Bills b WHERE b.date >= ?1 AND b.date <= ?2 AND b.status=1  OR b.date = ?3 AND b.status=1 ORDER BY b.date')->setParameters( array(1=>$datd,2=>$d,3=>$d));
        $entities = $query->getResult();

        return $this->render('UerpMainBundle::home.html.twig',
            array ('bills' => $entities,'chart'=> $chart,
            ));

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
