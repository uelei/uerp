<?php

namespace Uerp\CustomerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CompanyPersonType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fancyName')
            ->add('cnpj')
            ->add('stateRegistry')
            ->add('cityRegistry')
            ->add('contact')
            ->add('contactPhone')
            ->add('contactEmail')
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
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Uerp\CustomerBundle\Entity\CompanyPerson'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'uerp_customerbundle_companyperson';
    }
}
