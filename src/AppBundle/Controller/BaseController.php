<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;

class BaseController extends Controller
{
    public function searchAction()
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('AppBundle:Category')->createQueryBuilder('c');
        $categories = $qb->where('c.enabled = 1 AND c.parent = 30')->orderBy('c.name', 'ASC')->getQuery()->setMaxResults(15)->getResult();
        $variables = array(
            'categories' => $categories
        );
        return $this->render('AppBundle:Block:search.html.twig', $variables);
    }
    public function menuAction()
    {
        $sql = "SELECT
          id,parent_id,name,parent_id,alias,image_url,body,meta_keyword,meta_description,position,image_feature
            FROM category
          WHERE category.enabled = 1";
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $categories = $this->buildTree($stmt->fetchAll());
        $variables = array(
            'categories' => $categories
        );
        return $this->render('AppBundle:Block:menu.html.twig', $variables);
    }

    public function buildTree(array $elements, $parentId = null, $parent_id_field = 'parent_id') {
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
    public static function setMetaData()
    {
        $data['title'] = 'Mỹ phẩm đẹp rạng ngời';
        return $data;
    }
}
