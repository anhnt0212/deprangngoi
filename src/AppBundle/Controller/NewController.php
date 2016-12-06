<?php

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NewController extends Controller
{
    public function indexAction(Request $request)
    {
        $this->data['title'] = 'Mỹ phẩm đẹp rạng ngời';
        $this->data['item']['alias'] = 'danh-sach-san-pham';
        $this->data['item']['alias'] = 'muc-san-pham';
        $alias = $request->get('slug', NULL);
        return $this->render('AppBundle:News:index.html.twig',$this->data);
    }
}
