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
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'updatedAt'
    );
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Chi tiết', array(
                'class' => 'col-md-8',
                'box_class' => 'box'
            ))
            ->add('name', 'text', [
                'required' => true,
                'label'=>'Tên sản phẩm',
                'attr' => array('class' => 'meta-title'),

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
                            )
                        )
                    ),
                    'uiColor' => '#ffffff'
                ),
                'label' =>'Mô tả ngắn'
            ))
            ->add('body', 'ckeditor', array(
                'label' =>'Bài viết mô tả'
            ))
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
                    '1' => 'Đang bày bán',
                    '0' => 'Đang ẩn'
                ),
                'data' => 1
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
                'label'=>'Link thân thiện',
                'attr' => array('class' => 'alias'),
            ])
            ->add('metaDescription', 'text', ['required' => FALSE,'label'=>'Mô tả'])
            ->add('metaKeyword', 'text', ['required' => FALSE,'label'=>'Từ khoá'])
            ->add('inSale', 'choice', array(
                'label' => 'Khuyến Mãi',
                'required' => FALSE,
                'choices' => array
                (
                    '0' => 'Không',
                    '1' => 'Khuyến Mãi'
                ),
            ))
            ->add('inHot', 'choice', array(
                'label' => 'Hot',
                'required' => FALSE,
                'choices' => array
                (
                    '0' => 'Không',
                    '1' => 'Sản Phẩm Hot'
                ),
            ))
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
    public function prePersist($object) {
        $this->preUpdate($object);
    }

    public function preUpdate($object) {

    }
}