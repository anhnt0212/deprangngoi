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
use Doctrine\ORM\EntityRepository;

class CategoryAdmin extends AbstractAdmin
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
            ->add('name', 'text',[
                'required'=>true,
                'label' =>'Tên danh mục',
                'attr' => array('class' => 'meta-title'),
            ])
            ->add('enabled', 'choice', array(
                'label' => 'Trạng thái',
                'choices' => array
                (
                    '1' => 'Kích hoạt',
                    '0' => 'Không'
                ),
            ))
            ->add('image_url', 'text')
            ->add('imageFeature', 'sonata_type_model_list', array(
                'required' => FALSE,
                'label' =>'Hình ảnh'
            ), array('link_parameters' => array('context' => 'category')))
            ->add('parent', 'entity', array(
                'class' => 'AppBundle:Category',
                'empty_value' => 'Đang là thư mục cha',
                'label' =>'Thư mục cha',
                'query_builder' => function(EntityRepository $er) {
                    $qb = $er->createQueryBuilder('c');
                    $qb->where('c.parent IS NULL');
                    if ($id = $this->getRequest()->get('id', 0)):
                        $qb->andWhere('c.id <>' . $id);
                    endif;
                    $qb->orderBy('c.name', 'ASC');
                    return $qb;
                }
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
                'label' =>'Bài viết'

            ))
            ->end()
            ->with('SEO', array('class' => 'col-sm-4'))
            ->add('alias', 'text', [
                'required' => true,
                'attr' => array('class' => 'alias'),
            ])
            ->add('metaDescription', 'text')
            ->add('metaKeyword', 'text')
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')->addIdentifier('name','',['Label'=>'Tên'])->add('parent', null, array(
            'associated_property' => 'name',
            'admin_code' => 'jobz_admin.catelogy'
        ), array('admin_code' => 'jobz_admin.catelogy'))->addIdentifier('enabled');
    }
    public function prePersist($object) {
        $this->preUpdate($object);
    }

    public function preUpdate($object) {

    }
}