<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use AppBundle\Controller\BaseController;

class HomeController extends Controller
{
    protected $layout = null;
    public function indexAction()
    {
        $this->data['title'] = 'Mỹ phẩm đẹp rạng ngời';
        $this->data['item']['alias'] = 'muc-san-pham';
        $this->data['product']['alias'] = 'chi-tiet-san-pham';
        return $this->render('AppBundle:Home:index.html.twig',$this->data);
    }
}
