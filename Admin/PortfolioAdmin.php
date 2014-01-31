<?php

namespace Ant\Bundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class PortfolioAdmin extends Admin
{
    protected $baseRouteName = 'pf';
    protected $baseRoutePattern = 'pf';


    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text', array(
                'label'=>'portfolio.title',
                'attr' => array('class'=>'form-control')
            ))
            ->add('description', 'textarea', array(
                'label'=>'portfolio.description',
                'attr' => array('class'=>'form-control')
            ))
            ->add('metaKey', 'text', array(
                'label'=>'portfolio.metaKey',
                'attr' => array('class'=>'form-control')
            ))
            ->add('metaDesc', 'text', array(
                'label'=>'portfolio.metaDesc',
                'attr' => array('class'=>'form-control')
            ))
            ->add('position', 'text', array(
                'label'=>'portfolio.position',
                'attr' => array('class'=>'form-control')
            ))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title',null, array(
        'label'=>'portfolio.title'
    ))
            ->add('description',null, array(
                'label'=>'portfolio.title'
            ))
            ->add('metaKey',null, array(
                'label'=>'portfolio.description'
            ))
            ->add('metaDesc',null, array(
                'label'=>'portfolio.metaDesc'
            ))
            ->add('position',null, array(
                'label'=>'portfolio.position'
            ))
            ->add('created',null, array(
                'label'=>'portfolio.created'
            ))
            ->add('id',null, array(
                'label'=>'portfolio.id'
            ))
        ;
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id',null, array(
                'label'=>'portfolio.id'
            ))
            ->add('title',null, array(
                'label'=>'portfolio.title'
            ))
            ->add('position',null, array(
                'label'=>'portfolio.position'
            ))
            ->add('created',null, array(
                'label'=>'portfolio.created'
            ))

        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id',null, array(
                'label'=>'portfolio.id'
            ))
            ->add('title',null, array(
                'label'=>'portfolio.title'
            ))
            ->add('created',null, array(
                'label'=>'portfolio.created'
            ))
            ->add('_action', 'actions', array(
                'label'=>'admin.action',
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }


}
