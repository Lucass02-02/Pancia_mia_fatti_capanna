<?php // File: AppORM/Control/CCart.php
namespace AppORM\Control;

use AppORM\Entity\EClient;
use AppORM\Entity\EOrderItem;
use AppORM\Entity\OrderStatus;
use AppORM\Entity\ReservationStatus;
use AppORM\Services\Foundation\FEntityManager;
use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\USession;
use AppORM\Services\Utility\UView;
use LDAP\Result;

class CCart
{
    public static function add(): void
    {
        if (!USession::isSet('user_id')) {
            // URL pulito
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }

        $clientId = USession::getValue('user_id');
        $client = FEntityManager::getInstance()->retriveObject(EClient::class, $clientId);
        $reservations = $client->getReservations();
        
        foreach($reservations as $reservation) {
            if($reservation->getStatus() === ReservationStatus::ORDER_IN_PROGRESS) {
                $order = $reservation->getOrders()->first();
                $orderId = $order->getIdOrder();
            }
        }

        if (UHTTPMethods::isPost()) {
            $productId = (int) UHTTPMethods::getPostValue('product_id');
            $quantity = (int) UHTTPMethods::getPostValue('quantity', 1);
            $fromCart = UHTTPMethods::getPostValue('from_cart');

            if ($productId > 0 && $quantity > 0) {
                $product = FPersistentManager::getInstance()->getProductById($productId);

                if ($product) {
                        
                    $orderItem = FEntityManager::getInstance()->retriveObjectOnTwoAttributes(EOrderItem::class, 'order_id', $orderId, 'product_id', $productId);
                    if($orderItem) {
                        $orderItem->setQuantity($orderItem->getQuantity + $quantity);
                    } else {
                        $orderItem = new EOrderItem($quantity);
                        $orderItem->setOrder($order);
                        $orderItem->setProduct($product);
                        $orderItem->setPrice($product->getPrice());
                        FPersistentManager::getInstance()->uploadObject($orderItem);
                    }

                    if ($fromCart) {
                        // URL pulito
                        header('Location: /Pancia_mia_fatti_capanna/cart/view');
                    } else {
                        // URL pulito
                        header('Location: /Pancia_mia_fatti_capanna/Client/order');
                    }
                    exit;
                }
            }
        }
        // URL pulito
        header('Location: /Pancia_mia_fatti_capanna/Client/order');
        exit;
    }
    
    public static function addAll(): void {
        if (!USession::isSet('user_id')) {
            // URL pulito
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }
        if (UHTTPMethods::isPost()) {
            $productIds = UHTTPMethods::getPostValue('product_ids', []);
            if (!empty($productIds) && is_array($productIds)) {
                $cart = USession::getValue('cart', []);
                foreach ($productIds as $productId) {
                    $product = FPersistentManager::getInstance()->getProductById((int)$productId);
                    if ($product) {
                        $pId = $product->getIdProduct();
                        if (isset($cart[$pId])) {
                            $cart[$pId]['quantity']++;
                        } else {
                            $cart[$pId] = ['product_id' => $pId, 'name' => $product->getName(), 'price' => $product->getPrice(), 'quantity' => 1];
                        }
                    }
                }
                USession::setValue('cart', $cart);
            }
        }
        // URL pulito
        header('Location: /Pancia_mia_fatti_capanna/home/menu');
        exit;
    }

    public static function view(): void {
        if (!USession::isSet('user_id')) {
            // URL pulito
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }

        $clientId = USession::getValue('user_id');
        $client = FEntityManager::getInstance()->retriveObject(EClient::class, $clientId);
        $reservations = $client->getReservations();

        foreach($reservations as $reservation) {
            if($reservation->getStatus() === ReservationStatus::ORDER_IN_PROGRESS) {
                $order = $reservation->getOrders()->first();
                $orderId = $order->getIdOrder();
            }
        }

        $orderItems = FEntityManager::getInstance()->retriveObjectList(EOrderItem::class, 'order', $orderId);

        UView::render('cart', ['cartItems' => $orderItems]);
    }

    public static function remove(): void {
        if (!USession::isSet('user_id')) {
            // URL pulito
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }
        if (UHTTPMethods::isPost()) {
            $productId = (int) UHTTPMethods::getPostValue('product_id');
            $removeOne = UHTTPMethods::getPostValue('remove_one');
            $cart = USession::getValue('cart', []);
            if (isset($cart[$productId])) {
                if ($removeOne && $cart[$productId]['quantity'] > 1) {
                    $cart[$productId]['quantity']--;
                } else {
                    unset($cart[$productId]);
                }
                USession::setValue('cart', $cart);
            }
        }
        // URL pulito
        header('Location: /Pancia_mia_fatti_capanna/cart/view');
        exit;
    }
    
    public static function clear(): void {
        if (!USession::isSet('user_id')) {
            // URL pulito
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }
        if (UHTTPMethods::isPost()) {
            USession::setValue('cart', []);
        }
        // URL pulito
        header('Location: /Pancia_mia_fatti_capanna/cart/view');
        exit;
    }



    public static function checkout() {
        if (!USession::isSet('user_id')) {
            // URL pulito
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }

        //implementa la funzione per pagare

        $clientId = USession::getValue('user_id');
        $client = FEntityManager::getInstance()->retriveObject(EClient::class, $clientId);
        $reservations = $client->getReservations();
        
        foreach($reservations as $reservation) {
            if($reservation->getStatus() === ReservationStatus::ORDER_IN_PROGRESS) {
                $order = $reservation->getOrders()->first();
                
                if($reservation && $order) {
                    $reservation->setStatus(ReservationStatus::ENDED);
                    $order->setStatus(OrderStatus::PAID);
                    FPersistentManager::getInstance()->uploadObject($reservation);
                    FPersistentManager::getInstance()->uploadObject($order);
                }
            }
        }

        UView::render('payment_success');
        

    }
}