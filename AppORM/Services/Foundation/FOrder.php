<?php

namespace AppORM\Services\Foundation;

use AppORM\Entity\EOrder;
use AppORM\Services\Foundation\FEntityManager;
use AppORM\Entity\EReservation;
use AppORM\Entity\ReservationStatus;
use AppORM\Entity\EOrderItem;

class FOrder {

    public static function getOrderById($idOrder) {
        $results = FEntityManager::getInstance()->retriveObject(EOrder::getEntity(), $idOrder);
        return $results;
    }

    public static function getOrderByClient($clientId) {
        $results = FEntityManager::getInstance()->retriveObjectOnAttribute(EOrder::getEntity(), 'client', $clientId);
        return $results;
    }

    public static function getOrderListByDate($date) {
        $results = FEntityManager::getInstance()->retriveObjectList(EOrder::getEntity(), 'date', $date);
        return $results;
    }


    public static function createOrder(EReservation $reservation) {
        if ($reservation->getStatus() == ReservationStatus::APPROVED) {
            $order = new EOrder($date = $reservation->getDate());
            $order->setReservation($reservation);
            FEntityManager::getInstance()->saveObject($order);
            return $order;
        }

    }


    public static function calculateTotalPrice(EOrder $order ) {
        $totalPrice = 0;
        $orderItems = FEntityManager::getInstance()->selectAll(EOrderItem::getEntity());

        foreach ($orderItems as $item) {
            if ($item->getOrder() === $order) {
                $totalPrice += $item->getPrice() * $item->getQuantity();
            }
        }

        return $totalPrice;
    }
}