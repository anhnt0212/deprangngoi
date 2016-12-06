<?php

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    public function indexAction(Request $request)
    {
        $data['title'] = 'Mỹ phẩm đẹp rạng ngời';
        $data['item']['alias'] = 'muc-san-pham';
        $data['product']['alias'] = 'chi-tiet-san-pham';
        $conn = $this->getDoctrine()->getConnection();
        $slug = $request->get('alias', NULL);
        $manager = $this->getDoctrine()->getManager();
        $careertools = $manager->getRepository('AppBundle:Product')
            ->createQueryBuilder('p')
            ->join('p.categories', 'c')
            ->where("LOWER(c.alias) = " . $conn->quote(mb_strtolower(trim($slug)), \PDO::PARAM_STR));
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($careertools, $request->query->getInt('page', 1), 5);
        $data['items'] = $pagination;
        return $this->render('AppBundle:Category:index.html.twig',$data);
    }
}
