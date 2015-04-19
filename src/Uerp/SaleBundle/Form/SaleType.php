<?php

namespace Uerp\SaleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SaleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         // $datea = new \Datetime('now');
        $builder
            ->add('date','date',array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                // 'data' => $datea

                ))
            ->add('totalcost')
            ->add('totalsale')
            ->add('discount')
            ->add('saleobs')
            ->add('seller')
            ->add('status')
            ->add('customer')
            ->add('nitems')
            ->add('tax')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uerp\SaleBundle\Entity\Sale'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'uerp_salebundle_sale';
    }
}
