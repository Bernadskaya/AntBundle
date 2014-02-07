<?php

namespace Ant\Bundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ImageAdmin extends Admin
{
    protected $baseRouteName = 'images';
    protected $baseRoutePattern = 'images';

    protected function configureFormFields(FormMapper $formMapper)
    {
        if ($this->hasParentFieldDescription()) {
            $getter = 'get'.$this->getParentFieldDescription()->getFieldName();
            $parent = $this->getParentFieldDescription()->getAdmin()->getSubject();
            if ($parent) {
                $image = $parent->$getter();
            } else {
                $image = null;
            }
        } else {
            $image = $this->getSubject();
        }

        $fileFieldOptions = array(
            'label'    => 'news.file',
            'required' => false,
        );

        if ($image && $image instanceof \Ant\Bundle\Entity\Image && $webPath = $image->getWebPath()) {
            $fileFieldOptions['help'] = '<img src="'.$webPath.'" class="admin-preview" />';
        }

        $formMapper
            ->add('uploadFile', 'file', $fileFieldOptions)
        ;
    }
}
