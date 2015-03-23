<?php

namespace Uerp\IncomesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class incomesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('saleid')
            ->add('valueb')
            ->add('valuel')
            ->add('tax')
            ->add('date')
            ->add('status')
            ->add('tpayment')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uerp\IncomesBundle\Entity\incomes'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'uerp_incomesbundle_incomes';
    }
}
