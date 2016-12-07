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

class ProductAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Chi tiết', array(
                'class' => 'col-md-8',
                'box_class' => 'box'
            ))
            ->add('name', 'text', [
                'required' => true,
                'label'=>'Tên sản phẩm'
            ])
            ->add('typeName', 'text',[  'label'=>'Tên kiểu','required' => false,])
            ->add('productCode', 'text',[  'label'=>'Mã SP','required' => false,])
            ->add('specification', 'text',[  'label'=>'Quy cách đóng gói','required' => false,])
            ->add('weights', 'text',[  'label'=>'Trọng lượng','required' => false,])
            ->add('madeIn', 'text',[  'label'=>'Nước sản xuất','required' => false,])
            ->add('trademark', 'text',[  'label'=>'Nhãn hiệu hàng hoá','required' => false,])
            ->add('price', 'number',[  'label'=>'Giá sản phẩm','required' => true,])
            ->add('priceOld', 'number',[  'label'=>'Giá cũ','required' => true,])
            ->add('description', 'ckeditor', array(
                'config' => array(
                    'toolbar' => array(
                        array(
                            'name' => 'basicstyles',
                            'items' => array(
                                'Bold', 'Italic', 'Underline',
                                '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord',
                                '-', 'Undo', 'Redo',
                                '-', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent',
                                '-', 'Blockquote',
                                '-', 'Image', 'Link', 'Unlink', 'Table'
                            )
                        )
                    ),
                    'uiColor' => '#ffffff'
                ),
                'label' =>'Mô tả ngắn'
            ))
            ->add('body', 'ckeditor', array(
                'config' => array(
                    'toolbar' => array(
                        array(
                            'name' => 'basicstyles',
                            'items' => array(
                                'Bold', 'Italic', 'Underline',
                                '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord',
                                '-', 'Undo', 'Redo',
                                '-', 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent',
                                '-', 'Blockquote',
                                '-', 'Image', 'Link', 'Unlink', 'Table'
                            )
                        )
                    ),
                    'uiColor' => '#ffffff',
                ),
                'label' =>'Bài viết mô tả'


            ))
            ->add('image', 'text')
            ->add('imageFeature', 'sonata_type_model_list', array(
                'required' => FALSE,
                'label' =>'Hình đại diện'
            ), array('link_parameters' => array('context' => 'product')))
            ->add('gallery', 'sonata_type_model_list', array(
                'required' => false,
                'label' =>'Danh sách hình'
            ), array(
                'link_parameters' => array(
                    'context' => 'product'
                )
            ))
            ->add('categories', 'entity', array(
                'property' => 'name',
                'class' => 'AppBundle\Entity\Category',
                'empty_value' => 'Select Category',
                'multiple' => true,
                'required' => FALSE,
                'label' =>'Danh mục sản phẩm'
            ))
            ->add('enabled', 'choice', array(
                'label' => 'Trạng thái',
                'choices' => array
                (
                    '0' => 'Đang ẩn',
                    '1' => 'Đang bày bán'
                ),
            ))
            ->add('createdAt', 'sonata_type_date_picker', array(
                'label' => 'Tạo ngày',
                'format' => 'yyyy/MM/dd',
                'required' => FALSE
            ))
            ->add('updatedAt', 'sonata_type_date_picker', array(
                'label' => 'Cập nhật ngày',
                'format' => 'yyyy/MM/dd',
                'required' => FALSE
            ))
            ->end()
            ->with('SEO', array('class' => 'col-sm-4'))
            ->add('alias', 'text', [
                'required' => true,
            ])
            ->add('metaDescription', 'text', ['required' => FALSE])
            ->add('metaKeyword', 'text', ['required' => FALSE])
            ->end()
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')->addIdentifier('name')->addIdentifier('price')->addIdentifier('priceOld')->addIdentifier('enabled')
            ->add('_action', null, array('actions' => array(
                'edit' => array(),
                'delete' => array(),
            )
            ));
    }
}