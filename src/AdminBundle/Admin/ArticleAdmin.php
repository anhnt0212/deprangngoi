<?php
/**
 * Created by PhpStorm.
 * User: JOBZREFER
 * Date: 11/24/2016
 * Time: 11:05 AM
 */

namespace AdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\HttpFoundation\File\File;

class ArticleAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Chi tiết', array(
                'class' => 'col-md-8',
                'box_class' => 'box'
            ))
            ->add('title', 'text', [
                'required' => true,
                'label' => 'Tiêu đề'
            ])
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
                'label' => 'Mô tả'
            ))
            ->add('content', 'ckeditor', array(
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
                'label' => 'Bài viết'


            ))
            ->add('imageUrl', 'text')
            ->add('imageFeature', 'sonata_type_model_list', array(
                'required' => FALSE,
                'label' => 'Hình đại diện'
            ), array('link_parameters' => array('context' => 'article')))
            ->add('categories', 'entity', array(
                'property' => 'name',
                'class' => 'AppBundle\Entity\Catelogy',
                'empty_value' => 'Vui lòng chọn danh m',
                'multiple' => true,
                'required' => FALSE,
                'label' => 'Danh mục'
            ))
            ->add('enabled', 'choice', array(
                'label' => 'Trạng Thái',
                'choices' => array
                (
                    '0' => 'Đang ẩn',
                    '1' => 'Công Khai'
                ),
            ))
            ->add('tags', 'collection', ['required' => FALSE])
            ->add('createdAt', 'sonata_type_date_picker', array(
                'label' => 'Tạo ngày',
                'format' => 'yyyy/MM/dd',
                'required' => FALSE
            ))
            ->add('updatedAt', 'sonata_type_date_picker', array(
                'label' => 'Cập nhật lúc',
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
        $datagridMapper->add('title');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')->addIdentifier('title','text',['label'=>'Tên'])->addIdentifier('enabled','', array(
            'label' => 'Trạng Thái'))->addIdentifier('createdAt')
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