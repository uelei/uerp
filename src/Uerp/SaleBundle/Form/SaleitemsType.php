<?php

namespace Uerp\SaleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SaleitemsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prod_id')
            ->add('qtd')
            ->add('prodcost')
            ->add('prodprice')
            ->add('subtotalcost')
            ->add('subtotalsale')
            ->add('itenaux')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uerp\SaleBundle\Entity\Saleitems'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'uerp_salebundle_saleitems';
    }
}
