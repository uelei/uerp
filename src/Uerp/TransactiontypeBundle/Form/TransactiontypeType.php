<?php

namespace Uerp\TransactiontypeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TransactiontypeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('transactiondesc')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uerp\TransactiontypeBundle\Entity\Transactiontype'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'uerp_transactiontypebundle_transactiontype';
    }
}
