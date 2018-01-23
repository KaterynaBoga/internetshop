<?php
// src/AppBundle/Admin/OrderItemAdmin.php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class OrderItemAdmin extends AbstractAdmin

{

    public function getParentAssociationMapping()
    {
        return 'order';
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('product')
            ->add('count');

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('product')
            ->add('count')
            ->add('amount');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('product')
            ->addIdentifier('count')
            ->addIdentifier('amount');

    }
}
