<?php
/**
 * Created by PhpStorm.
 * User: JOBZREFER
 * Date: 11/24/2016
 * Time: 11:06 AM
 */

namespace AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PurchaseAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Chi tiết đơn hàng', array(
                'class' => 'col-md-8',
                'box_class' => 'box'
            ))
            ->add('purchaseNo', 'text', ['label' => 'Mã đơn hàng'])
            ->add('deliveryDate', 'sonata_type_date_picker', array(
                'label' => 'Ngày Giao',
                'format' => 'yyyy/MM/dd',
                'required' => FALSE
            ))
            ->add('createdAt', 'sonata_type_date_picker', array(
                'label' => 'Tạo Ngày',
                'format' => 'yyyy/MM/dd',
                'required' => FALSE
            ))
            ->add('deliveryHour', 'time', array(
                'label' => 'Giờ Giao',
                'required' => FALSE
            ))
            ->add('customerName', 'text', ['label' => 'Tên khách hàng'])
            ->add('customerPhone', 'text', ['label' => 'SĐT khách hàng'])
            ->add('customerEmail', 'email', ['label' => 'Email khách hàng'])
            ->add('customerAddress', 'text', ['label' => 'Địa chỉ khách hàng'])
//            ->add('purchasedItems', 'sonata_type_collection', array(
//                'by_reference' => false,
//                'type_options' => array()), array(
//                'edit' => 'inline',
//                'inline' => 'table',
//                'label' => false,
//                'required' => FALSE
//            ))
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('customerName')->add('customerPhone')->add('customerEmail');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')->addIdentifier('customerName')->addIdentifier('customerPhone')->addIdentifier('customerEmail');
    }
    public function prePersist($object) {
        $this->preUpdate($object);
    }

    public function preUpdate($object) {

    }

}