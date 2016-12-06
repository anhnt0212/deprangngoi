<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;

class HomeController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('AppBundle:Category')->createQueryBuilder('c');
        $categories = $qb->where('c.enabled = 1')->orderBy('c.name', 'ASC');
        echo "<pre>";
        print_r($value = get_class_methods($categories));
        exit();
        $this->data['title'] = 'Mỹ phẩm đẹp rạng ngời';
        $this->data['item']['alias'] = 'muc-san-pham';
        $this->data['product']['alias'] = 'chi-tiet-san-pham';
        return $this->render('AppBundle:Home:index.html.twig',$this->data);
    }
}
