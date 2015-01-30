<?php

namespace Uerp\BillsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\ORM\EntityRepository;

class BillsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $factory = $builder->getFormFactory(); 

         $builder
            ->add('date','date',array(
    'widget' => 'single_text',
    // this is actually the default format for single_text
    'format' => 'yyyy-MM-dd',
))
            ->add('value')
            ->add('docorigin')
            ->add('dataaux')
            ->add('categories','entity',array(
                'class' => 'Uerp\CategoriesBundle\Entity\Categories',
                'property' => 'name',
                'mapped' => false,
                'empty_value'=> 'chosse a categories',
                'attr' => array('class' => 'submitOnChange',)
                ))

            ->add('account')
            ->add('status')
            ->add('supplier')
        ;

$refreshSubcategories = function ($form, $categories ) use( $factory)
{            if (!empty($categories)) {
                $form->add('subcategories', 'entity', array(
                    'class' => 'Uerp\SubcategoriesBundle\Entity\Subcategories',
                    'label' => 'Select Subcategories',
                    'query_builder' => function (EntityRepository $er) use ($categories) {

                        $qb = $er->createQueryBuilder('subcategories');
 
                        if ($categories instanceof Categories) {
                            $qb = $qb->where('subcategories.categories = :categories')
                                ->setParameter('categories', $categories);
                        }
                        elseif (is_numeric($categories)) {
                            $qb = $qb->innerJoin('subcategories.categories', 'categories')
                                ->where('categories.id = :id')
                                ->setParameter('id', $categories);
                        }  else {
                            $qb = $qb->where('subcategories.id = 1 ');
                        }
 
                        return $qb;
                    },
                    'empty_value' => 'Choose Subcategories',
                    // 'position' => array(    // requires egeloen/ordered-form-bundle
                    //     'after' => 'categories'
                    // ),
                    'property' => 'name',
                    'validation_groups' => false,
                    'attr' => array(
                        'class' => 'clearOnChange'
                    )
                ));
            }
};


$builder->addEventListener(FormEvents::PRE_SET_DATA,function (FormEvent $event ) use( $refreshSubcategories)
{
$form = $event->getForm();
$data = $event->getData();
    if(null === $data)
         return;


            $accessor = PropertyAccess::createPropertyAccessor();
 
            $subcategories = $accessor->getValue($data, 'subcategories');
            $categories = ($subcategories) ? $subcategories->getCategories() : null;
 
            $refreshSubcategories($form, $categories);

});



$builder->addEventListener(FormEvents::POST_SET_DATA, function(FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();
 
            if (null === $data)
                return;
 
            $accessor = PropertyAccess::createPropertyAccessor();
 
            $subcategories = $accessor->getValue($data, 'subcategories');
            $categories = ($subcategories) ? $subcategories->getCategories() : null;
 
            if ($categories)
                $form->get('categories')->setData($categories);
 
        });
 
        // Below is used to load the car selectbox when brand is submitted
        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($refreshSubcategories) {
            $form = $event->getForm();
            $data = $event->getData();
 
            if (array_key_exists('categories', $data)) {
                $refreshSubcategories($form, $data['categories']);
            }
        });
 




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
