<?php

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    public function indexAction(Request $request)
    {
        $data['title'] = 'Mỹ phẩm đẹp rạng ngời';
        $slug = $request->get('alias', NULL);
        $manager = $this->getDoctrine()->getManager();
        $category = $manager->getRepository('AppBundle:Category')->findOneBy(array('alias' => trim($slug)));
        $product = $manager->getRepository('AppBundle:Product')
            ->createQueryBuilder('p')
            ->join('p.categories', 'c')
            ->where("c.id = " .$category->getId())
            ->getQuery()->getArrayResult();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($product, $request->query->getInt('page', 1), 15);
        $data['items'] = $pagination;
        $data['category'] = $category;
        return $this->render('AppBundle:Category:index.html.twig',$data);
    }
}
