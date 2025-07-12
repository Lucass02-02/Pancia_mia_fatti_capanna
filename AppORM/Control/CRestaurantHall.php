<?php // File: AppORM/Control/CRestaurantHall.php

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

        $error_message = USession::getValue('hall_management_error', null);
        USession::unsetValue('hall_management_error'); // Rimuovilo subito dopo averlo letto

        UView::render('manage_halls', [
            'halls' => $halls,
            'error' => $error_message // Passa l'errore al template
        ]);
    }

    public static function create(): void
    {
        self::checkAdmin();
        if (UHTTPMethods::isPost()) {
            $name = UHTTPMethods::getPostValue('name');
            $totalPlaces = (int)UHTTPMethods::getPostValue('totalPlaces');
            if ($name && $totalPlaces > 0) {
                // Assumendo che saveRestaurantHall restituisca un bool per successo/fallimento
                $saved = FPersistentManager::getInstance()->saveRestaurantHall($name, $totalPlaces);
                if (!$saved) {
                    USession::setValue('hall_management_error', 'Errore durante la creazione della sala.');
                }
            } else {
                USession::setValue('hall_management_error', 'Nome e Posti Totali sono obbligatori per creare una sala.');
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/RestaurantHall/manage');
        exit;
    }

    /**
     * Cancella una sala esistente leggendo l'ID da un form POST.
     */
    public static function delete(): void
    {
        self::checkAdmin();
        if (UHTTPMethods::isPost()) {
            $id = (int)UHTTPMethods::getPostValue('hall_id');
            if ($id > 0) {
                $hall = FPersistentManager::getInstance()->getRestaurantHallById($id);
                if ($hall) {
                    try {
                        FPersistentManager::getInstance()->deleteRestaurantHall($hall);
                        // Successo: nessun errore da impostare in sessione
                    } catch (\Exception $e) {
                        // Cattura l'eccezione e memorizza il suo messaggio direttamente nella sessione
                        USession::setValue('hall_management_error', $e->getMessage());
                    }
                } else {
                    USession::setValue('hall_management_error', 'Sala non trovata.');
                }
            } else {
                USession::setValue('hall_management_error', 'ID sala non valido.');
            }
        }
        // Reindirizza sempre alla pagina di gestione
        header('Location: /Pancia_mia_fatti_capanna/RestaurantHall/manage');
        exit;
    }
}