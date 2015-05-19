<?php

namespace Uerp\CustomerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CustomerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('phone_number')
            ->add('mobile_number')
            ->add('email')
            ->add('birth_date')
            ->add('street')
            ->add('street_number')
            ->add('complement')
            ->add('district')
            ->add('postal_code')
            ->add('city')
            ->add('notes')
            ->add('company','entity',array(
                'class' => 'Uerp\CustomerBundle\Entity\CompanyPerson',
                'property' => 'company',))
            ->add('individual','entity',array(
               	'class' => 'Uerp\CustomerBundle\Entity\IndividualPerson',
                'property' => 'individual',))            
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uerp\CustomerBundle\Entity\Customer'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'uerp_customerbundle_customer';
    }
}
