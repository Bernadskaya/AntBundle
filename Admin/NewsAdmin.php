<?php

namespace Ant\Bundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class NewsAdmin extends Admin
{
    protected $baseRouteName = 'news';
    protected $baseRoutePattern = 'news';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', 'text', array(
                'label' => 'news.title',
                'attr'  => array('class' => 'form-control')
            ))
            ->add('description', 'textarea', array(
                'label' => 'news.description',
                'attr'  => array('class' => 'form-control')
            ))
            ->add('text', 'textarea', array(
                'required' => false,
                'label'    => 'news.text',
                'attr'     => array(
                    'class'   => 'tinymce form-control',
                    'tinymce' => '{"theme":"simple"}',
                )
            ))
            ->add('metaKey', 'text', array(
                'label' => 'news.metaKey',
                'attr'  => array('class' => 'form-control')
            ))
            ->add('metaDesc', 'textarea', array(
                'label' => 'news.metaDesc',
                'attr'  => array('class' => 'form-control')
            ))
            ->add('image', 'sonata_type_admin', array(
                'label' => false,
            ), array(
                'edit' => 'admin',
            ))
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title', 'text', array('label' => 'news.title'))
            ->add('description', 'text', array('label' => 'news.description'))
            ->add('text', 'text', array(
                'required' => false,
                'label'    => 'news.text'
            ))
            ->add('metaKey', 'text', array('label' => 'news.metaKey'))
            ->add('metaDesc', 'text', array('label' => 'news.metaDesc'))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title', null, array('label' => 'news.title'))
            ->add('created', 'doctrine_orm_datetime_range', array(
                'input_type' => 'timestamp',
                'label'      => 'news.created',
            ))
            ->add('updated', 'doctrine_orm_datetime_range', array(
                'input_type' => 'timestamp',
                'label'      => 'news.updated',
            ))
            ->add('id', null, array('label' => 'news.id'))
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id', null, array('label' => 'news.id'))
            ->add('title', null, array('label' => 'news.title'))
            ->add('created', null, array('label' => 'news.created'))
            ->add('updated', null, array('label' => 'news.updated'))
            ->add('_action', 'actions', array(
                'label'   => 'admin.actions',
                'actions' => array(
                    'show'   => array(),
                    'edit'   => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    public function prePersist($news)
    {
        $this->manageEmbeddedImageAdmins($news);
    }

    public function preUpdate($news)
    {
        $this->manageEmbeddedImageAdmins($news);
    }

    private function manageEmbeddedImageAdmins($news)
    {
        foreach ($this->getFormFieldDescriptions() as $fieldName => $fieldDescription) {
            if ($fieldDescription->getType() === 'sonata_type_admin'
                && ($associationMapping = $fieldDescription->getAssociationMapping())
                && $associationMapping['targetEntity'] === 'Ant\Bundle\Entity\Image'
            ) {
                $getter = 'get'.$fieldName;
                $setter = 'set'.$fieldName;

                $image = $news->$getter();

                if ($image) {
                    $request = $this->getRequest()->get($fieldDescription->getAdmin()->getUniqid());
                    if ((!is_object($image->getUploadFile()) && !$image->getPath())
                        || isset($request[$fieldName]['_delete'])
                    ) {
                        $news->$setter(null);
                    } else {
                        $image->setNews($news);
                        $image->setUpdated(new \DateTime());
                    }
                }
            }
        }
    }
}
