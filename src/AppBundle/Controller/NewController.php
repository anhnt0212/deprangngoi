<?php

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\BaseController as Base;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewController extends Base
{
    public function __construct()
    {
       parent::__construct();
    }
    public function indexAction(Request $request)
    {
        $this->data['item']['alias'] = 'danh-sach-san-pham';
        $this->data['item']['alias'] = 'muc-san-pham';
        $alias = $request->get('slug', NULL);
        return $this->render('AppBundle:News:index.html.twig',$this->data);
    }
}
