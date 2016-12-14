<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    public function indexAction(Request $request)
    {
        $data = \AppBundle\Controller\BaseController::setMetaData();
        $slug = $request->get('alias', NULL);
        $manager = $this->getDoctrine()->getManager();
        $category = $manager->getRepository('AppBundle:Category')->findOneBy(array('alias' => trim($slug)));
        if (is_null($category)) {
            return $this->redirectToRoute('app_homepage', array(), 301);
        }
        $sql = "SELECT id,parent_id,name,parent_id,alias,image_url,body,meta_keyword,meta_description,position,image_feature
            FROM category
          WHERE category.enabled = 1 AND category.parent_id =" . $category->getId();
        $stmt = $manager->getConnection()->prepare($sql);
        $stmt->execute();
        $allCategory = $stmt->fetchAll();
        $array_id = [];
        if ($allCategory) {
            foreach ($allCategory as $key => $value) {
                array_push($array_id, $value['id']);
            }
        }
        array_push($array_id, $category->getId());
        $product = $manager->getRepository('AppBundle:Product')
            ->createQueryBuilder('p')
            ->join('p.categories', 'c')
            ->where('c.id IN (:category_id)')
            ->setParameter('category_id', $array_id)
            ->orderBy('p.updatedAt', 'DESC')
            ->getQuery()->getResult();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($product, $request->query->getInt('page', 1), 15);
        $qb = $manager->getRepository('AppBundle:Article')->createQueryBuilder('a');
        $articles = $qb->where('a.enabled = 1')->orderBy('a.updatedAt', 'DESC')->getQuery()->setMaxResults(5)->getResult();
        $data['items'] = $pagination;
        $data['category'] = $category;
        $data['articles'] = $articles;
        return $this->render('AppBundle:Category:index.html.twig', $data);
    }
}
