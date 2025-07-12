<?php // File: AppORM/Control/COwner.php
namespace AppORM\Control;

use AppORM\Entity\DayOfWeek;
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
use AppORM\Entity\ERestaurantHall;
use AppORM\Entity\ETurn;
use AppORM\Entity\TurnName;

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
            
            $order = FEntityManager::getInstance()->retriveObject(EOrder::class, $orderId);
            if($order ) {
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


    public static function manageTurns() {
        if (USession::getValue('user_role') !== 'admin') {
             header('Location: /Pancia_mia_fatti_capanna/'); 
             exit;
        }

        $halls = FEntityManager::getInstance()->selectAll(ERestaurantHall::class);

        $turns = FEntityManager::getInstance()->selectAll(ETurn::class);

        $enumCases = DayOfWeek::cases();
        $enumValues = [];

        foreach($enumCases as $case) {
            $enumValues[$case->name] = $case->value;
        }

        $enumCases2 = TurnName::cases();
        $enumValues2 = [];

        foreach($enumCases2 as $case) {
            $enumValues2[$case->name] = $case->value;
        }

        $error_message = USession::getValue('turn_management_error', null);
        USession::unsetValue('turn_management_error');

        UView::render('manage_turns', ['turns' => $turns, 'enumValues' => $enumValues, 'enumValues2' => $enumValues2, 'error' => $error_message, 'halls' => $halls]);
    }

    public static function deleteTurn() {
        if (USession::getValue('user_role') !== 'admin') {
             header('Location: /Pancia_mia_fatti_capanna/'); 
             exit;
        }

        if (UHTTPMethods::isPost()) {
            $id = (int)UHTTPMethods::getPostValue('turn_id');
            if ($id > 0) {
                $turn = FEntityManager::getInstance()->retriveObject(ETurn::class, $id);
                if ($turn) {
                    try {
                        FEntityManager::getInstance()->deleteObject($turn);
                        
                    } catch (\Exception $e) {
                        
                        USession::setValue('turn_management_error', $e->getMessage());
                    }
                } else {
                    USession::setValue('turn_management_error', 'Turno non trovato.');
                }
            } else {
                USession::setValue('turn_management_error', 'ID turno non valido.');
            }
        }
        
        header('Location: /Pancia_mia_fatti_capanna/Admin/manageTurns/');
        exit;
    }

    public static function createTurn() {
        if (USession::getValue('user_role') !== 'admin') {
             header('Location: /Pancia_mia_fatti_capanna/'); 
             exit;
        }

        if(UHTTPMethods::isPost()) {
            $dayOfWeekStr = UHTTPMethods::getPostValue('dayOfWeek');
            $turnNameStr = UHTTPMethods::getPostValue('turno');
            $startTimeStr = UHTTPMethods::getPostValue('start_time');
            $endTimeStr = UHTTPMethods::getPostValue('end_time');
            $hallId = UHTTPMethods::getPostValue('hall_id');

            $startTime = new DateTime($startTimeStr);
            $endTime = new DateTime($endTimeStr);

            $turnName = TurnName::from($turnNameStr);
            $dayOfWeek = DayOfWeek::from($dayOfWeekStr);

            $hall = FEntityManager::getInstance()->retriveObject(ERestaurantHall::class, $hallId);

            if ($dayOfWeek && $turnName && $startTime && $endTime && $hallId) {
                $turn = new ETurn($turnName, $dayOfWeek, $startTime, $endTime);
                $turn->setRestaurantHall($hall);
                FPersistentManager::getInstance()->uploadObject($turn);
            } 
        }
    }
} 