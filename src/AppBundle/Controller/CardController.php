<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;


class CardController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = new Session();

        //load location
        $sql = "SELECT city_code,city_name FROM transport_fees WHERE transport_fees.enabled = 1 GROUP BY transport_fees.city_code";
        $em = $this->getDoctrine()->getManager();
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $city = $stmt->fetchAll();
        //end load
        $data = \AppBundle\Controller\BaseController::setMetaData();
        $data['city'] = $city;
        if ($request->isMethod('post')) {
            if (!$session->get('card')) {
                $card = [];
            } else {
                $card = $session->get('card');
            }
            $productId = $request->get("productId");
            if (!is_null($productId)) {
                $manager = $this->getDoctrine()->getManager();
                $product = $manager->getRepository('AppBundle:Product')->findOneBy(array('id' => intval($productId)));
                if (!is_null($product)) {
                    if (!$session->get($productId)) {
                        $card_array = array
                        (
                            'quantity' => 1,
                            'product' => $product,
                            'timestamp' => strtotime('now')
                        );
                    } else {
                        $card_array = $session->get($productId);
                        $quantity = intval($card_array['quantity']) + 1;
                        $session->remove($productId);
                        $card_array = array(
                            'quantity' => $quantity,
                            'product' => $product,
                            'timestamp' => strtotime('now')
                        );
                    }
                    $session->set($productId, $card_array);
                }
                $card[$productId] = $session->get($productId);
                $session->set('card', $card);
                $card = $session->get('card');
                $data['items'] = $card;
                $priceTotal = $this->getTotal($card);
                $data['priceTotal'] = $priceTotal;
                return $this->redirectToRoute('app_product_card', array(), 301);
            } elseif (!is_null($card)) {
                $priceTotal = $this->getTotal($card);
                $data['priceTotal'] = $priceTotal;
                $data['items'] = $card;
                return $this->redirectToRoute('app_product_card', array(), 301);
            } else {
                return $this->redirectToRoute('app_homepage', array(), 301);
            }
        } elseif ($request->isMethod('get')) {
            $card = $session->get('card');
            $priceTotal = $this->getTotal($card);
            $data['priceTotal'] = $priceTotal;
            if (is_null($card)) {
                return $this->redirectToRoute('app_homepage', array(), 301);
            }
            $data['items'] = $card;
            return $this->render('AppBundle:Card:index.html.twig', $data);
        } else {
            return $this->redirectToRoute('app_homepage', array(), 301);
        }

    }

    public function getTotal($card)
    {
        $priceTotal = 0;
        if ($card) {
            foreach ($card as $key => $value) {
                $priceTotal += $value['product']->getPrice() * $value['quantity'];
            }
        }
        return $priceTotal;
    }
    public function submitAction(Request $request){
        if ($request->isMethod('post')) {
           $products = $request->get('product');
            $customeName = $request->get('fullname');
            $customer_phone = $request->get('phone');
            $customer_email = $request->get('email');
            $customer_address = $request->get('address');
        }
    }
}
