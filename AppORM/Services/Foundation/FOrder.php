<?php

namespace AppORM\Services\Foundation;

use AppORM\Entity\EOrder;
use AppORM\Services\Foundation\FEntityManager;
use AppORM\Entity\EReservation;
use AppORM\Entity\ReservationStatus;
use AppORM\Entity\EOrderItem;

class FOrder {

    // MODIFICA: Chiamate a FEntityManager corrette e usato EOrder::class
    
    public static function getOrderById($idOrder) {
        return FEntityManager::retriveObject(EOrder::class, $idOrder);
    }

    public static function getOrderByClient($clientId) {
        return FEntityManager::retriveObjectOnAttribute(EOrder::class, 'client', $clientId);
    }

    public static function getOrderListByDate($date) {
        // Nota: retriveObjectList non è tra i metodi che mi hai mostrato per FEntityManager.
        // Se esiste, la sintassi corretta è questa. Altrimenti dovrai implementarlo.
        return FEntityManager::retriveObjectList(EOrder::class, 'date', $date);
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