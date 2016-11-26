<?php

namespace AppBundle\Controller;
use AppBundle\Controller\BaseController as Base;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Base
{
    public function __construct()
    {
        parent::__construct();
    }
    public function indexAction()
    {
        $this->data['item']['alias'] = 'muc-san-pham';
        $this->data['product']['alias'] = 'chi-tiet-san-pham';
        return $this->render('AppBundle:Home:index.html.twig',$this->data);
    }
}
