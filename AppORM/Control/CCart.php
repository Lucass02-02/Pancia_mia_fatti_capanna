<?php
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

class CCart
{
    private static function getActiveOrder($client)
    {
        foreach ($client->getReservations() as $reservation) {
            if ($reservation->getStatus() === ReservationStatus::ORDER_IN_PROGRESS) {
                return $reservation->getOrders()->first();
            }
        }
        return null;
    }

    private static function checkClientAndReservation(): array
    {
        if (!USession::isSet('user_id')) {
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }

        $clientId = USession::getValue('user_id');
        $client = FEntityManager::getInstance()->retriveObject(EClient::class, $clientId);
        $order = self::getActiveOrder($client);

        if (!$order) {
            UView::render('client_no_reservation');
            exit;
        }

        return [$client, $order];
    }

    public static function add(): void
    {
        list($client, $order) = self::checkClientAndReservation();

        if (UHTTPMethods::isPost()) {
            $productId = (int) UHTTPMethods::getPostValue('product_id');
            $quantity = (int) UHTTPMethods::getPostValue('quantity', 1);
            $fromCart = UHTTPMethods::getPostValue('from_cart');

            if ($productId > 0 && $quantity > 0) {
                $product = FPersistentManager::getInstance()->getProductById($productId);

                if ($product) {
                    $orderItem = FEntityManager::getInstance()->retriveObjectOnTwoAttributes(
                        EOrderItem::class,
                        'order', $order,
                        'product', $product
                    );

                    if ($orderItem) {
                        $orderItem->setQuantity($orderItem->getQuantity() + $quantity);
                    } else {
                        $orderItem = new EOrderItem($quantity);
                        $orderItem->setOrder($order);
                        $orderItem->setProduct($product);
                        $orderItem->setPrice($product->getCost());
                    }

                    FPersistentManager::getInstance()->uploadObject($orderItem);

                    header('Location: ' . ($fromCart ? '/Pancia_mia_fatti_capanna/cart/view' : '/Pancia_mia_fatti_capanna/Client/order'));
                    exit;
                }
            }
        }

        header('Location: /Pancia_mia_fatti_capanna/Client/order');
        exit;
    }

    public static function view(): void
    {
        list($client, $order) = self::checkClientAndReservation();

        $orderItems = FEntityManager::getInstance()->retriveObjectList(EOrderItem::class, 'order', $order);
        UView::render('cart', ['cartItems' => $orderItems]);
    }

    public static function checkout(): void
    {
        list($client, $order) = self::checkClientAndReservation();

        foreach ($client->getReservations() as $reservation) {
            if ($reservation->getStatus() === ReservationStatus::ORDER_IN_PROGRESS) {
                $reservation->setStatus(ReservationStatus::ENDED);
                $order->setStatus(OrderStatus::PAID);
                break;
            }
        }

        UView::render('payment_success');
    }

    public static function clear(): void
    {
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

    public static function remove(): void
    {
        if (!USession::isSet('user_id')) {
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

        header('Location: /Pancia_mia_fatti_capanna/cart/view');
        exit;
    }

    public static function addAll(): void
    {
        if (!USession::isSet('user_id')) {
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
                            $cart[$pId] = [
                                'product_id' => $pId,
                                'name' => $product->getName(),
                                'price' => $product->getCost(),
                                'quantity' => 1
                            ];
                        }
                    }
                }
                USession::setValue('cart', $cart);
            }
        }

        header('Location: /Pancia_mia_fatti_capanna/home/menu');
        exit;
    }
}
