<?php

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\BaseController as Base;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Base
{
    public function __construct()
    {
       parent::__construct();
    }
    public function indexAction(Request $request)
    {
        $this->data['item']['alias'] = 'muc-san-pham';
        $this->data['product']['alias'] = 'chi-tiet-san-pham';
        $alias = $request->get('slug', NULL);
        return $this->render('AppBundle:Category:index.html.twig',$this->data);
    }
}
