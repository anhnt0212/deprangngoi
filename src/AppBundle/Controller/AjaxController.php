<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AjaxController extends Controller
{
    public function loadCityAction(Request $request)
    {
        $response = array();
        $code = $request->get('city_code');
        if ($code) {
            //load location
            $sql = "SELECT destination,price FROM transport_fees WHERE transport_fees.enabled = 1 AND transport_fees.city_code=" . $code;
            $em = $this->getDoctrine()->getManager();
            $stmt = $em->getConnection()->prepare($sql);
            $stmt->execute();
            $city = $stmt->fetchAll();
            if (!is_null($city)) {
                $html = '';
                foreach ($city as $key => $value) {
                    $html .= "<option value='" . $value['price'] . "'>" . $value['destination'] . "</option>";
                }
                $response['status'] = 200;
                $response['message'] = 'System error !';
                $response['data'] = $city;
                $response['html'] = $html;
            } else {
                $response['status'] = 201;
                $response['message'] = 'No data !';
            }
        } else {
            $response['status'] = 500;
            $response['message'] = 'System error !';
            $response['data'] = '';
        }
        //end load
        return new Response(json_encode($response));
    }
}
