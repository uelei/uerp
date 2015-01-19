<?php
/**
 * Created by PhpStorm.
 * User: uelei
 * Date: 19/01/15
 * Time: 12:21 PM
 */

namespace Uerp\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class PrincipalController extends Controller {



    public function novoAction()
    {
        return $this->render('UerpUserBundle:Principal:index.html.twig');
    }





}