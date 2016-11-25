<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        $data['title'] = 'Đẹp Rạng Ngời';
        return $this->render('AppBundle:Home:index.html.twig',$data);
    }
}
