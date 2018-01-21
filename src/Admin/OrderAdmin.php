<?php
// src/AppBundle/Admin/OrderAdmin.php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class OrderAdmin extends AbstractAdmin

{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('user')
            ->add('createdAt')
            ->add('count')
            ->add('amount')
            ->add('customerName')
            ->add('phone')
            ->add('email')
            ->add('addres')
            ->add('status')
            ->add('isPaid');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('user')
            ->add('createdAt')
            ->add('count')
            ->add('amount')
            ->add('customerName')
            ->add('phone')
            ->add('email')
            ->add('addres')
            ->add('status')
            ->add('isPaid');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('user')
            ->add('createdAt')
            ->add('count')
            ->add('amount')
            ->add('customerName')
            ->add('phone')
            ->add('email')
            ->add('addres')
            ->add('status')
            ->add('isPaid');

    }
}
