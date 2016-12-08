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
use Doctrine\ORM\EntityRepository;

class CatelogyAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text',[
                'required'=>true,
                'label' =>'Tên',
                'attr' => array('class' => 'meta-title'),
            ])
            ->add('alias', 'text',[
                'required'=>true,
                'label' =>'Link thân thiện',
                'attr' => array('class' => 'alias'),
            ])
            ->add('enabled', 'choice', array(
                'label' => 'Trạng thái',
                'choices' => array
                (
                    '1' => 'Kích hoạt',
                    '0' => 'Không'
                ),
            ))
            ->add('parent', 'entity', array(
                'class' => 'AppBundle:Catelogy',
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
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')->addIdentifier('name','text',['Label'=>'Tên'])->add('parent', null, array(
            'associated_property' => 'name',
            'admin_code' => 'jobz_admin.catelogy'
            ), array('admin_code' => 'jobz_admin.catelogy'))
            ->addIdentifier('enabled');
    }
    public function prePersist($object) {
        $this->preUpdate($object);
    }

    public function preUpdate($object) {

    }
}