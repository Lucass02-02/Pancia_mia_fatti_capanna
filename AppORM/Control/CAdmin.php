<?php // File: AppORM/Control/COwner.php
namespace AppORM\Control;

use AppORM\Entity\EReservation;
use AppORM\Entity\ReservationStatus;
use AppORM\Services\Foundation\FEntityManager;
use AppORM\Services\Utility\USession;
use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\UView;
use DateTime;
use AppORM\Entity\EOrder;
use AppORM\Entity\EOrderItem;

class CAdmin {

     public static function profile(): void
    {
        if (USession::getValue('user_role') !== 'admin') {
            header('Location: /Pancia_mia_fatti_capanna/');
            exit;
        }
        $adminId = USession::getValue('user_id');
        $admin = FPersistentManager::getInstance()->getAdminById($adminId);
        $userRole = USession::getValue('user_role');
        if ($admin) {
            UView::render('admin_profile', ['admin' => $admin, 'userRole' => $userRole]);
        } else {
            CClient::logout();
        }
    }
    
    
    public static function manageClients(): void
    {
        if (USession::getValue('user_role') !== 'admin') {
            header('Location: /Pancia_mia_fatti_capanna/');
            exit;
        }
        $userRole = USession::getValue('user_role');

        $clients = FPersistentManager::getInstance()->getAllClients();
        UView::render('manage_clients', ['clients' => $clients, 'userRole' => $userRole]);
    }



    public static function showReservations() {

        if (USession::getValue('user_role') !== 'admin') {
            header('Location: /Pancia_mia_fatti_capanna/');
            exit;
        }

        $filterDate = UHTTPMethods::getPostValue('filter_date');

        if ($filterDate) {

            $reservations = FEntityManager::getInstance()->retriveObjectList(EReservation::class, 'date', $filterDate);
        } else {
            $reservations = FEntityManager::getInstance()->selectAll(EReservation::class);
        }
        
        
        
        UView::render('manage_reservation', ['reservations' => $reservations, 'filter_date' => $filterDate]);
        
    }



    public static function updateReservationState() {
        if (USession::getValue('user_role') !== 'admin') {
            header('Location: /Pancia_mia_fatti_capanna/');
            exit;
        }

        if (UHTTPMethods::isPost()) {
            $reservationId = (int)UHTTPMethods::getPostValue('reservation_id');
            $newState = UHTTPMethods::getPostValue('status');

            $reservation = FEntityManager::getInstance()->retriveObject( EReservation::class, $reservationId);
            if ($reservation && $newState) {
                try {
                    $stateEnum = ReservationStatus::from($newState);
                    $reservation->setStatus($stateEnum);
                    FPersistentManager::getInstance()->uploadObject($reservation);

                    if ($reservation->getStatus() === ReservationStatus::APPROVED) {
                        //$existingOrder = FEntityManager::getInstance()->findOneBy(EOrder::class, 'reservation', $reservation);
                        $existingOrder = $reservation->getOrders();

                        if ($existingOrder->isEmpty()) {
                            FPersistentManager::getInstance()->createOrderFromReservation($reservation);
                        }
                        
                    } elseif ($reservation->getStatus() === ReservationStatus::CANCELED || $reservation->getStatus() === ReservationStatus::ENDED) {
                        FPersistentManager::getInstance()->deleteReservation($reservation);
                    }
                } catch (\ValueError $e) {
                    // Stato non valido, non fare nulla
                }
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/Admin/showReservations');
        exit;

    }

    public static function showOrders() {
        if (USession::getValue('user_role') !== 'admin') {
            header('Location: /Pancia_mia_fatti_capanna/');
            exit;
        }

        $userRole = USession::getValue('user_role');

        $message = USession::getValue('flash_message');
        if ($message) {
            USession::setValue('flash_message', null);
        }
            
        
        $filterDate = UHTTPMethods::getPostValue('filter_date');
        if ($filterDate) {
            UHTTPMethods::setPostValue('filter_date', null);
        }

        if ($filterDate) {
            $orders = FEntityManager::getInstance()->retriveObjectList(EOrder::class, 'date', $filterDate);
        } else {
            $orders = FEntityManager::getInstance()->selectAll(EOrder::class);
        }

        UView::render('waiter_manage_order', ['orders' => $orders, 'filter_date' => $filterDate, 'error' => $message, 'user_role' => $userRole]);
    }


    public static function enableOrder() {
        if (USession::getValue('user_role') !== 'admin') {
             header('Location: /Pancia_mia_fatti_capanna/'); 
             exit;
        }

        if (UHTTPMethods::isPost()) {
            $orderId = (int)UHTTPMethods::getPostValue('order_id');
            //$newState = UHTTPMethods::getPostValue('status');

            $order = FEntityManager::getInstance()->retriveObject(EOrder::class, $orderId);
            if($order ) {
                //$stateEnum = OrderStatus::from($newState);
                $result = FPersistentManager::getInstance()->unlockOrder($order);
            }
        }

        if ($result === true) {
            header('Location: /Pancia_mia_fatti_capanna/Admin/showOrders');
            exit;
        }else{
            USession::setValue('flash_message', $result);
            header('Location: /Pancia_mia_fatti_capanna/Admin/showOrders');
        }

        
    }

    public static function detailOrder() {
        if (USession::getValue('user_role') !== 'admin') {
             header('Location: /Pancia_mia_fatti_capanna/'); 
             exit;
        }

        $userRole = USession::getValue('user_role');

        $orderId = UHTTPMethods::getPostValue('order_id');

        $order_items = FEntityManager::getInstance()->retriveObjectList(EOrderItem::class, 'order', $orderId);

        UView::render('waiter_order_detail', ['order_items' => $order_items, 'user_role' => $userRole]);
    }
}