<?php
// File: AppORM/Control/CRestaurantHall.php
namespace AppORM\Control;

use AppORM\Entity\ERestaurantHall;
use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\USession;
use AppORM\Services\Utility\UView;

class CRestaurantHall
{
    private static function checkAdmin(): void {
        if (USession::getValue('user_role') !== 'admin') {
            header('Location: /Pancia_mia_fatti_capanna/');
            exit;
        }
    }

     public static function manage(): void {
        self::checkAdmin();
        $halls = FPersistentManager::getInstance()->getAllRestaurantHalls();
        UView::render('manage_halls', ['halls' => $halls]);
    }

    public static function create(): void
    {
        self::checkAdmin();
        if (UHTTPMethods::isPost()) {
            $name = UHTTPMethods::getPostValue('name');
            $totalPlaces = (int)UHTTPMethods::getPostValue('totalPlaces');
            if ($name && $totalPlaces > 0) {
                $hall = new ERestaurantHall($name, $totalPlaces);
                FPersistentManager::getInstance()->saveRestaurantHall($hall);
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/hall/manage');
        exit;
    }
    
    /** * Cancella una sala esistente.
     * Modificato per accettare l'ID come segmento dell'URL.
     */
    public static function delete(int $id): void
    {
        self::checkAdmin();
        // L'ID viene passato come parametro della funzione, non da query GET
        if ($id > 0) {
            $hall = FPersistentManager::getInstance()->getRestaurantHallById($id);
            if ($hall) {
                FPersistentManager::getInstance()->deleteRestaurantHall($hall);
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/hall/manage');
        exit;
    }
}