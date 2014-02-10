<?php

namespace Ant\Bundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class AdAdmin extends Admin
{
    protected $baseRouteName = 'ads';
    protected $baseRoutePattern = 'ads';

    protected function configureFormFields(FormMapper $formMapper)
    {
        $adGroupFieldOptions = array(
            'property' => 'title',
            'label'    => 'ad.group',
            'attr'     => array('class' => 'form-control')
        );
        $formMapper
            ->add('text', 'textarea', array(
                'required' => false,
                'label'    => 'ad.text',
                'attr'     => array(
                    'class'   => 'form-control tinymce',
                    'tinymce' => '{"theme":"simple"}',
                )
            ))
            ->add('adGroup', 'sonata_type_model', $adGroupFieldOptions)
            ->add('position', 'text', array(
                'required' => false,
                'attr'     => array('class' => 'form-control'),
                'label'    => 'ad.position'
            ))
            ->add('url', 'text', array(
                'required' => false,
                'attr'     => array('class' => 'form-control'),
                'label'    => 'ad.url'
            ))
            ->add('image', 'sonata_type_admin', array(
                'label' => false,
            ), array(
                'edit' => 'admin',
            ))
        ;
    }

    protected function AdQuery($id)
    {
        $em = $this->modelManager->getEntityManager('Ant\Bundle\Entity\Ad');

        $queryBuilder = $em->createQueryBuilder('a')
            ->select('a')
            ->from('AntBundle:Ad', 'a')
            ->where('a.adGroup = :id')->setParameter('id', $id)
        ;

        return $queryBuilder;
    }

    protected function AdGroupQuery($id)
    {
        $em = $this->modelManager->getEntityManager('Ant\Bundle\Entity\AdGroup');

        $queryBuilder = $em->createQueryBuilder('a')
            ->select('a')
            ->from('AntBundle:AdGroup', 'a')
            ->where('a.id = :id')->setParameter('id', $id)
        ;

        return $queryBuilder;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id', null, array('label' => 'ad.id'))
            ->add('adGroup.title', null, array('label' => 'ad.group'))
            ->add('text', null, array('template' => 'AntBundle::list_custom.html.twig'))
            ->add('url', null, array('label' => 'ad.url'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show'   => array(),
                    'edit'   => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    public function prePersist($ad)
    {
        $this->manageEmbeddedImageAdmins($ad);
    }

    public function preUpdate($ad)
    {
        $this->manageEmbeddedImageAdmins($ad);
    }

    private function manageEmbeddedImageAdmins($ad)
    {
        foreach ($this->getFormFieldDescriptions() as $fieldName => $fieldDescription) {
            if ($fieldDescription->getType() === 'sonata_type_admin'
                && ($associationMapping = $fieldDescription->getAssociationMapping())
                && $associationMapping['targetEntity'] === 'Ant\Bundle\Entity\Image'
            ) {
                $getter = 'get'.$fieldName;
                $setter = 'set'.$fieldName;

                $image = $ad->$getter();

                if ($image) {
                    $request = $this->getRequest()->get($fieldDescription->getAdmin()->getUniqid());
                    if ((!is_object($image->getUploadFile()) && !$image->getPath())
                        || isset($request[$fieldName]['_delete'])
                    ) {
                        $ad->$setter(null);
                    } else {
                        $image->setAd($ad);
                        $image->setUpdated(new \DateTime());
                    }
                }
            }
        }
    }
}
