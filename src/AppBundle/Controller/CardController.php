<?php

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CardController extends Controller
{
    public function indexAction(Request $request)
    {
        $this->data['title'] = 'Mỹ phẩm đẹp rạng ngời';
        $this->data['item']['alias'] = 'muc-san-pham';
        $this->data['product']['alias'] = 'chi-tiet-san-pham';
        $alias = $request->get('slug', NULL);
        return $this->render('AppBundle:Card:index.html.twig',$this->data);
    }
}
