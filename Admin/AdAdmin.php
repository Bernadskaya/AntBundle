<?php
/**
 * Created by PhpStorm.
 * User: nevada
 * Date: 07.01.14
 * Time: 14:53
 */

namespace Ant\Bundle\Admin;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class AdAdmin extends Admin {

    protected $baseRouteName = 'ads';
    protected $baseRoutePattern = 'ads';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $adGroupFieldOptions = array(
            'property'=>'title',
            'label'=>'ad.group',
            'attr' => array('class'=>'form-control')
        );
        $formMapper
            ->add('text','textarea', array(
                'required' => false,
                'label'=>'ad.text',
                'attr' => array(
                    'class' => 'form-control tinymce',
                    'tinymce'=>'{"theme":"simple"}',
                )))
            ->add('file','file', array (
                'required' => false,
                'label'=>'ad.file',
            ))
            ->add('adGroup', 'sonata_type_model', $adGroupFieldOptions)
            ->add('position','text', array (
                'required' => false,
                'attr' => array('class'=>'form-control'),
                'label'=>'ad.position'
            ))
            ->add('url','text', array (
                'required' => false,
                'attr' => array('class'=>'form-control'),
                'label'=>'ad.url'
            ))

        ;
    }

    protected  function AdQuery ($id) {
        $em = $this->modelManager->getEntityManager('Ant\Bundle\Entity\Ad');

        $queryBuilder = $em
            ->createQueryBuilder('a')
            ->select('a')
            ->from('AntBundle:Ad', 'a')
            ->where('a.adGroup = :id')
            ->setParameter('id', $id);

        return $queryBuilder;
    }

    protected function AdGroupQuery ($id) {
        $em = $this->modelManager->getEntityManager('Ant\Bundle\Entity\AdGroup');

        $queryBuilder = $em
            ->createQueryBuilder('a')
            ->select('a')
            ->from('AntBundle:AdGroup', 'a')
            ->where('a.id = :id')
            ->setParameter('id', $id);

        return $queryBuilder;

    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id',null, array(
                'label'=>'ad.id'))
            ->add('adGroup.title',null,array('label'=>'ad.group'))
            ->add('text', null, array('template' => 'AntBundle::list_custom.html.twig'))
            ->add('url',null, array(
                'label'=>'ad.url'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

} 