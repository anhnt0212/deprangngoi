<?php

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    public function indexAction()
    {
        $data = \AppBundle\Controller\BaseController::setMetaData();
        return $this->render('AppBundle:Contact:index.html.twig',$data);
    }
}
