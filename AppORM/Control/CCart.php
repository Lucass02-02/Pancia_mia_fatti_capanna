<?php // File: AppORM/Control/CCart.php
namespace AppORM\Control;

use AppORM\Entity\EClient;
use AppORM\Entity\EOrderItem;
use AppORM\Entity\EProduct;
use AppORM\Entity\OrderStatus;
use AppORM\Entity\ReservationStatus;
use AppORM\Services\Foundation\FEntityManager;
use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Foundation\FProduct;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\USession;
use AppORM\Services\Utility\UView;
use LDAP\Result;

class CCart
{
    public static function add(): void
    {
        if (!USession::isSet('user_id')) {
            
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
                        
                    $orderItem = FEntityManager::getInstance()->retriveObjectOnTwoAttributes(EOrderItem::class, 'order', $orderId, 'product', $productId);
                    if($orderItem) {
                        $orderItem->setQuantity($orderItem->getQuantity + $quantity);
                        FPersistentManager::getInstance()->uploadObject($orderItem);
                    } else {
                        $orderItem = new EOrderItem($quantity);
                        $orderItem->setOrder($order);
                        $orderItem->setProduct($product);
                        $orderItem->setPrice($product->getPrice());
                        FPersistentManager::getInstance()->uploadObject($orderItem);
                    }

                    if ($fromCart) {
                        
                        header('Location: /Pancia_mia_fatti_capanna/cart/view');
                    } else {
                        
                        header('Location: /Pancia_mia_fatti_capanna/Client/order');
                    }
                    exit;
                }
            }
        }
       
        header('Location: /Pancia_mia_fatti_capanna/Client/order');
        exit;
    }
    

    public static function addSingleQuantity() {
        if (!USession::isSet('user_id')) {
            
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

            if ($productId > 0 && $quantity > 0) {
                $product = FPersistentManager::getInstance()->getProductById($productId);

                if ($product) {
                        
                    $orderItem = FEntityManager::getInstance()->retriveObjectOnTwoAttributes(EOrderItem::class, 'order', $orderId, 'product', $productId);
                    if($orderItem) {
                        $orderItem->setQuantity($orderItem->getQuantity() + $quantity);
                        FPersistentManager::getInstance()->uploadObject($orderItem);
                    }

                    header('Location: /Pancia_mia_fatti_capanna/Cart/view');
        
                }
            }
        }
    }




    public static function view(): void {
        if (!USession::isSet('user_id')) {
            
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
            $removeOne = UHTTPMethods::getPostValue('remove_one');

            $orderItem = FEntityManager::getInstance()->retriveObjectOnTwoAttributes(EOrderItem::class, 'order', $orderId, 'product', $productId);

            if ($productId > 0 && $orderItem->getQuantity() >0 ) {
                $orderItem->setQuantity($orderItem->getQuantity() - $removeOne);
                FPersistentManager::getInstance()->uploadObject($orderItem);
                if ($orderItem->getQuantity() === 0) {
                    FEntityManager::getInstance()->deleteObject($orderItem);
                }
            }  
        }
        
        header('Location: /Pancia_mia_fatti_capanna/cart/view');
        exit;
    }


    public static function removeAll() {
        if (!USession::isSet('user_id')) {
            
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
            
            $orderItem = FEntityManager::getInstance()->retriveObjectOnTwoAttributes(EOrderItem::class, 'order', $orderId, 'product', $productId);

            if($productId > 0 && $orderItem->getORderItemId() > 0) {
                FEntityManager::getInstance()->deleteObject($orderItem);
            }

        }

        header('Location: /Pancia_mia_fatti_capanna/cart/view/');
        exit;

    }


    public static function emptyCart() {
        if (!USession::isSet('user_id')) {
            
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

            $orderItems = FEntityManager::getInstance()->retriveObjectList(EOrderItem::class, 'order', $orderId);

            FEntityManager::getInstance()->deleteObjects($orderItems);
        }

        header('Location: /Pancia_mia_fatti_capanna/Cart/view/');
        exit;
    }
    
    public static function clear(): void {
        if (!USession::isSet('user_id')) {
            
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }
        if (UHTTPMethods::isPost()) {
            USession::setValue('cart', []);
        }
        
        header('Location: /Pancia_mia_fatti_capanna/cart/view');
        exit;
    }



    public static function checkout() {
        if (!USession::isSet('user_id')) {
            
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }

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