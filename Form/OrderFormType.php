<?php

namespace Ant\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrderFormType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text', array (
                'required' => true,
                'attr' => array('class'=>'form-control'),
                'label'=>'order.name'))
            ->add('surname','text', array (
                'required' => true,
                'attr' => array('class'=>'form-control'),
                'label'=>'order.surname'))
            ->add('email','text', array (
                'required' => true,
                'attr' => array('class'=>'form-control'),
                'label'=>'order.email'))
            ->add('phone','text', array (
                'required' => true,
                'attr' => array('class'=>'form-control'),
                'label'=>'order.phone'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ant\Bundle\Entity\OrderForm',
            'translation_domain' => 'AntBundle'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ant_bundle_orderform';
    }
}
