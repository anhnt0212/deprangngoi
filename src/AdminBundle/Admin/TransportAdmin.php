<?php
/**
 * Created by PhpStorm.
 * User: JOBZREFER
 * Date: 11/25/2016
 * Time: 11:04 AM
 */

namespace AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Doctrine\ORM\EntityRepository;

class TransportAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('destination', 'text', [
                'required' => true,
            ])
            ->add('price', 'number')
            ->add('cityCode', 'number')
            ->add('cityName', 'text')
            ->add('enabled', 'choice', array(
                'label' => 'Enabled',
                'choices' => array
                (
                    '0' => 'True',
                    '1' => 'False'
                ),
            ));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('destination');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')->addIdentifier('destination')->addIdentifier('price')->addIdentifier('enabled');
    }
}