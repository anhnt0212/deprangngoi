<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    public function indexAction(Request $request)
    {
        $data = \AppBundle\Controller\BaseController::setMetaData();
        $alias = $request->get('slug', NULL);
        $manager = $this->getDoctrine()->getManager();
        $product = $manager->getRepository('AppBundle:Product')->findOneBy(array('alias' => trim($alias)));
        if ($product->getOld() == 1) {
            $sql = "SELECT * FROM product_gallery WHERE product_gallery.productId =" . $product->getId();
            $em = $this->getDoctrine()->getManager();
            $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute();
            $oldGallery = $stmt->fetchAll();
        } else {
            $oldGallery = null;
        }
        $data['item'] = $product;
        $data['oldGallery'] = $oldGallery;
        $category = $manager->getRepository('AppBundle:Category')
            ->createQueryBuilder('p')
            ->join('p.products', 'c')
            ->where("c.id = " . $product->getId())
            ->getQuery()->getArrayResult();
        $productLike = $manager->getRepository('AppBundle:Product')
            ->createQueryBuilder('p')
            ->join('p.categories', 'c')
            ->where("c.id = " . $category[0]['id'])
            ->getQuery()->setMaxResults(6)->getResult();
        $data['productLike'] = $productLike;
        return $this->render('AppBundle:Product:detail.html.twig', $data);
    }

    public function searchAction(Request $request)
    {
        $data = \AppBundle\Controller\BaseController::setMetaData();
        $keyword = $request->get('keyword');
        $manager = $this->getDoctrine()->getManager();
        $product = $manager->getRepository('AppBundle:Product')->createQueryBuilder('p');
        $like = "%" . mb_strtolower(trim(strip_tags($keyword))) . "%";
        $product->where("LOWER(p.name) LIKE :like OR LOWER(p.description) LIKE :like");
        $result = $product->setParameter('like', $like) ->getQuery()->getResult();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($result, $request->query->getInt('page', 1), 15);
        $data['items'] = $pagination;
        return $this->render('AppBundle:Product:search.html.twig', $data);
    }
}
