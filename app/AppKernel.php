<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Uerp\UserBundle\UerpUserBundle(),
            new Uerp\BankBundle\UerpBankBundle(),
            new Uerp\StatusBundle\UerpStatusBundle(),
            new Uerp\CategoriesBundle\UerpCategoriesBundle(),
            new Uerp\SellerBundle\UerpSellerBundle(),
            new Uerp\CustomerBundle\UerpCustomerBundle(),
            new Uerp\SaleBundle\UerpSaleBundle(),
            new Uerp\BillsBundle\UerpBillsBundle(),
            new Uerp\IncomesBundle\UerpIncomesBundle(),
            new Uerp\SupplierBundle\UerpSupplierBundle(),
            new Uerp\ProductBundle\UerpProductBundle(),
            new Uerp\MainBundle\UerpMainBundle(),
            new Uerp\SubcategoriesBundle\UerpSubcategoriesBundle(),
            new Uerp\tpaymentBundle\UerptpaymentBundle(),
            new Ob\HighchartsBundle\ObHighchartsBundle(),
            new Uerp\ReportBundle\UerpReportBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
