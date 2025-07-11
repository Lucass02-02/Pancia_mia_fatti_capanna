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
                        FPersistentManager::getInstance()->createOrderFromReservation($reservation);
                    } elseif ($reservation->getStatus() === ReservationStatus::CANCELED) {
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
}