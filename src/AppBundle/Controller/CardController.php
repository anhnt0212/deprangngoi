<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\Purchase;
use AppBundle\Entity\PurchaseItem;
use AppBundle\Extensions\Util;


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

    public function submitAction(Request $request)
    {
        $data = \AppBundle\Controller\BaseController::setMetaData();
        $variables = array();
        $session = new Session();
        if (!$session->get('card')) {
            $variables['msg'] = 'Bạn chưa có đơn hàng nào !';
            $data['variables'] = $variables;
        } else {
            if ($request->isMethod('post')) {
                $products = $request->get('product');
                $customer_name = $request->get('fullname');
                $customer_phone = $request->get('phone');
                $customer_email = $request->get('email');
                $customer_address = $request->get('address');
                $customer_description = $request->get('description');
                $priceTotal = $request->get('priceTotal');
                $shipPrice = $request->get('shipPrice');
                $totalCard = $request->get('totalCard');
                if (!is_null($products)) {
                    $manager = $this->getDoctrine()->getManager();
                    $purchase = new Purchase();
                    $purchase->setCustomerAddress($customer_address);
                    $purchase->setCustomerEmail($customer_email);
                    $purchase->setCustomerName($customer_name);
                    $purchase->setCustomerPhone($customer_phone);
                    $purchase->setcustomerDescription($customer_description);
                    $purchase->setTotalAll(floatval($totalCard));
                    $purchase->setShipPrice(floatval($shipPrice));
                    $purchase->setTotalPrice(floatval($priceTotal));
                    $util = new Util();
                    $purchase->setPurchaseNo($util->generateRandomString(5));
                    $manager->persist($purchase);
                    foreach ($products as $product) {
                        $item = new PurchaseItem();
                        $productObj = $manager->getRepository('AppBundle:Product')->findOneBy(array('id' => intval($product['productId'])));
                        $item->setProduct($productObj);
                        $item->setQuantity(intval($product['quantity']));
                        $item->setPurchase($purchase);
                        $manager->persist($item);
                    }
                    try {
                        $manager->flush();
                        $session->clear();
                        $success = "Đặt hàng thành công !";
                        $variables['msg'] = $success;
                    } catch (\Exception $ex) {
                        $errors = 'Lỗi hệ thống';
                        $variables['msg'] = $errors;
                    }
                    $data['variables'] = $variables;
                } else {
                    return new Response(json_encode($variables));
                }
            } else {
                $variables['msg'] = 'Bạn chưa có đơn hàng nào !';
                $data['variables'] = $variables;
            }
        }
        return $this->render("AppBundle:Card:result.html.twig", $data);
    }

    public function editAction(Request $request)
    {
        $variables = array();
        $session = new Session();
        $card = $session->get('card');
        $action = $request->query->get('action');
        $value = $request->query->get('value');
        if ($action && $value) {
            if ($action == 'delete') {
                unset($card[$value]);
                $session->remove('card');
                $session->set('card', $card);
            }
            if ($action == 'all') {
                $session->clear();
            }
        } else {
            return new Response(json_encode($variables));
        }
        return $this->redirectToRoute('app_product_card', array(), 301);
    }
}
