<?php

namespace Uerp\BillsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BillsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date','date',array(
    'widget' => 'single_text',
    // this is actually the default format for single_text
    'format' => 'yyyy-MM-dd',
))
            ->add('value')
            ->add('docorigin')
            ->add('dataaux')
            ->add('categories')
            ->add('account')
            ->add('transactiontype')
            ->add('status')
            ->add('supplier')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uerp\BillsBundle\Entity\Bills'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'uerp_billsbundle_bills';
    }
}
