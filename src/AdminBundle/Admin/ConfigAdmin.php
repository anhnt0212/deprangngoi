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

class ConfigAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Chi tiết', array(
                'class' => 'col-md-8',
                'box_class' => 'box'
            ))
            ->add('name', 'text', [
                'required' => FALSE,
                'label' =>'Tên'
            ])
            ->add('value', 'text', [
                'required' => FALSE,
                'label' =>'Giá trị'
            ])
            ->add('enabled', 'choice', array(
                'label' => 'Trạng thái',
                'choices' => array
                (
                    '0' => 'Không',
                    '1' => 'Kích hoạt'
                ),
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
                    'uiColor' => '#ffffff'
                ),
                'label' =>'Văn bản'

            ))
            ->add('type', 'number', [
                'required' => FALSE,
                'label' =>'Kiểu'
            ])
            ->end()
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')->addIdentifier('name')->addIdentifier('enabled');
    }
}