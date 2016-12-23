<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    public function indexAction()
    {
        $data = \AppBundle\Controller\BaseController::setMetaData();
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('AppBundle:Config')->createQueryBuilder('ad');
        $footer = $qb->getQuery()->setMaxResults(2)->getResult();
        if ($footer) {
            $data['contact'] = $footer[0];
            $data['facebook'] = $footer[1];
        }
        return $this->render('AppBundle:Contact:index.html.twig', $data);
    }
}
