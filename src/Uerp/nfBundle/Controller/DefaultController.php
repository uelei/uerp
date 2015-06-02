<?php

namespace Uerp\nfBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use DanfeNFePHP;


class DefaultController extends Controller
{
    /**
     *
     */
    public function indexAction()
    {
//        require_once('../../libs/NFe/DanfeNFePHP.class.php');

//$arq = $_GET['nfe'];
        $arq = '..//vendor/nfephp-org/nfephp/exemplos/xml/35101158716523000119550010000000011003000000-nfe.xml';

        if (is_file($arq)) {
            $docxml = file_get_contents($arq);
            $danfe = new DanfeNFePHP($docxml, 'P', 'A4', '../vendor/nfephp-org/nfephp/images/logo.jpg', 'I', '');
            $id = $danfe->montaDANFE();
            $teste = $danfe->printDANFE($id.'.pdf', 'I');
        }




    }
}
