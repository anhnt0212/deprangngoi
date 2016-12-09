<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewController extends Controller
{
    public function indexAction(Request $request)
    {
        $data = \AppBundle\Controller\BaseController::setMetaData();
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('AppBundle:Article')->createQueryBuilder('a');
        $articles = $qb->where('a.enabled = 1')->orderBy('a.updatedAt', 'DESC')->getQuery()->getResult();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($articles, $request->query->getInt('page', 1), 15);
        $data['items'] = $pagination;
        return $this->render('AppBundle:News:index.html.twig', $data);
    }

    public function detailAction(Request $request)
    {
        $data = \AppBundle\Controller\BaseController::setMetaData();
        $alias = $request->get('alias', NULL);
        $manager = $this->getDoctrine()->getManager();
        if ($alias) {
            $article = $manager->getRepository('AppBundle:Article')->findOneBy(array('alias' => trim($alias)));
            $data['item'] = $article;
        } else {
            $data['item'] = null;
        }
        $qb = $manager->getRepository('AppBundle:Article')->createQueryBuilder('a');
        $list = $qb->where('a.enabled = 1')->orderBy('a.updatedAt', 'DESC')->getQuery()->setMaxResults(6)->getResult();
        $data['list'] = $list;
        return $this->render('AppBundle:News:detail.html.twig', $data);
    }
}
