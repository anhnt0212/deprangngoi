<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\BaseController;

class HomeController extends Controller
{
    protected $layout = null;

    public function indexAction()
    {
        $data = \AppBundle\Controller\BaseController::setMetaData();
        $sql = "SELECT id,parent_id,name,parent_id,alias,image_url,body,meta_keyword,meta_description,position,image_feature,in_home FROM category WHERE category.enabled = 1 AND category.in_home =1";
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $categories = $stmt->fetchAll();
        $all_childs = [];
        foreach ($categories as $key => $value) {
            $product[$value['id']] = $value;
            $product[$value['id']]['product'] = [];
            $all_childs[$value['id']] = [];
            $qb = $em->getRepository('AppBundle:Category')->createQueryBuilder('c');
            $value['child'] = $qb->where('c.parent = (:ids)')->setParameter('ids', $value['id'])->getQuery()->getArrayResult();
            foreach ($value['child'] as $k) {
                array_push($all_childs[$value['id']], $k['id']);
            }
            $repository = $em->getRepository('AppBundle:Product');
            $product[$value['id']]['product']  = $repository->createQueryBuilder('p')
                ->innerJoin('p.categories', 'g')
                ->where('g.id IN (:category_id)')
                ->setParameter('category_id', $all_childs[$value['id']])
                ->orderBy('p.updatedAt','DESC')
                ->getQuery()->setMaxResults(6)->getResult();
        }
        $data['category'] = $product;
        return $this->render('AppBundle:Home:index.html.twig', $data);
    }

    public function buildTree(array $elements, $parentId = null, $parent_id_field = 'parent_id')
    {
        $branch = array();
        foreach ($elements as $element) {
            if ($element[$parent_id_field] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                $element['children'] = empty($children) ? [] : $children;

                $branch[] = $element;
            }
        }
        return $branch;
    }
}
