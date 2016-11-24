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
                )
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
                )

            ))
            ->add('categories', 'entity', array(
                'property' => 'name',
                'class' => 'AppBundle\Entity\Catelogy',
                'empty_value' => 'Select Category',
                'multiple' => true,
                'required' => FALSE
            ))
            ->add('enabled', 'choice', array(
                'label' => 'Enabled',
                'choices' => array
                (
                    '0' => 'True',
                    '1' => 'False'
                ),
            ))
            ->add('tags', 'collection')
            ->add('createdAt', 'sonata_type_date_picker', array(
                'label' => 'Created At',
                'format' => 'yyyy/MM/dd',
                'required' => FALSE
            ))
            ->add('updatedAt', 'sonata_type_date_picker', array(
                'label' => 'Created At',
                'format' => 'yyyy/MM/dd',
                'required' => FALSE
            ))
            ->end()
            ->with('SEO', array('class' => 'col-sm-4'))
            ->add('alias', 'text', [
                'required' => true,
            ])
            ->add('metaDescription', 'text')
            ->add('metaKeyword', 'text')
            ->end()
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')->addIdentifier('title')->addIdentifier('createdAt')->addIdentifier('enabled');
    }
}