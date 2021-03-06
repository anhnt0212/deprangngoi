<?php
/**
 * Created by PhpStorm.
 * User: JOBZREFER
 * Date: 11/25/2016
 * Time: 11:03 AM
 */

namespace AdminBundle\Admin;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Doctrine\ORM\EntityRepository;

class SliderAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Chi tiết', array(
                'class' => 'col-md-8',
                'box_class' => 'box'
            ))
            ->add('title', 'text', [
                'required' => FALSE,
            ])
            ->add('link', 'text', [
                'required' => FALSE,
            ])
            ->add('imageOld', 'text')
            ->add('imageFeature', 'sonata_type_model_list', array(
                'required' => FALSE
            ), array('link_parameters' => array('context' => 'slider')))
            ->add('enabled', 'choice', array(
                'label' => 'Enabled',
                'choices' => array
                (
                    '1' => 'Mở',
                    '0' => 'Tắt'
                ),
            ))
            ->add('position', 'number', [
                'required' => FALSE,
            ])
            ->end()
            ->with('SEO', array('class' => 'col-sm-4'))
            ->add('metaDescription', 'text', ['required' => FALSE])
            ->add('metaKeyword', 'text', ['required' => FALSE])
            ->add('metaTitle', 'text', ['required' => FALSE])
            ->end()
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')->addIdentifier('title')->addIdentifier('enabled');
    }
    public function prePersist($object) {
        $this->preUpdate($object);
    }

    public function preUpdate($object) {

    }
}