<?php
// File: AppORM/Control/CTable.php
namespace AppORM\Control;

use AppORM\Entity\ETable;
use AppORM\Entity\TableState;
use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\USession;
use AppORM\Services\Utility\UView;

class CTable
{
    private static function checkAdmin(): void {
        if (USession::getValue('user_role') !== 'admin') {
            header('Location: /Pancia_mia_fatti_capanna/');
            exit;
        }
    }

    public static function listAll(): void
    {
        self::checkAdmin();
        $tables = FPersistentManager::getInstance()->getAllTables();
        $halls = FPersistentManager::getInstance()->getAllRestaurantHalls();

        // Recupera il messaggio di errore dalla sessione e poi lo cancella
        $error_message = USession::getValue('table_creation_error', null);
        USession::unsetValue('table_creation_error');

        UView::render('manage_tables', [
            'tables' => $tables,
            'halls' => $halls,
            'error' => $error_message // Passa il messaggio di errore al template
        ]);
    }

    public static function create(): void
    {
        self::checkAdmin();
        if (UHTTPMethods::isPost()) {
            $seats = (int)UHTTPMethods::getPostValue('seatsNumber');
            $hallId = (int)UHTTPMethods::getPostValue('hall_id');

            if ($seats > 0 && $hallId > 0) {
                $hall = FPersistentManager::getInstance()->getRestaurantHallById($hallId);
                if ($hall) {
                    // *** NUOVO CONTROLLO: Verifica la capienza massima della sala ***
                    $currentTablesInHall = FPersistentManager::getInstance()->getTablesByRestaurantHall($hallId);
                    $currentSeats = 0;
                    foreach ($currentTablesInHall as $table) {
                        $currentSeats += $table->getSeatsNumber();
                    }

                    if (($currentSeats + $seats) > $hall->getTotalPlaces()) {
                        // Imposta il messaggio di errore nella sessione
                        USession::setValue('table_creation_error', 'Hai raggiunto o superato la capienza massima della sala selezionata.');
                    } else {
                        $table = new ETable($seats);
                        $table->setRestaurantHall($hall);
                        FPersistentManager::getInstance()->saveTable($table);
                        // Se la creazione ha successo, non impostare nessun errore
                    }
                } else {
                    USession::setValue('table_creation_error', 'Sala ristorante non trovata.');
                }
            } else {
                USession::setValue('table_creation_error', 'Il numero di posti e la sala sono obbligatori.');
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/table/listAll');
        exit;
    }
    
    public static function updateState(): void
    {
        self::checkAdmin();
        if (UHTTPMethods::isPost()) {
            $tableId = (int)UHTTPMethods::getPostValue('table_id');
            $newState = UHTTPMethods::getPostValue('state');

            $table = FPersistentManager::getInstance()->getTableById($tableId);
            if ($table && $newState) {
                try {
                    $stateEnum = TableState::from($newState);
                    $table->setState($stateEnum);
                    FPersistentManager::getInstance()->saveTable($table);
                } catch (\ValueError $e) {
                    // Stato non valido, non fare nulla
                }
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/table/listAll');
        exit;
    }

    /**
     * Cancella un tavolo.
     * Modificato per accettare l'ID come segmento dell'URL.
     */
    public static function delete(int $id): void
    {
        self::checkAdmin();
        // L'ID viene passato come parametro della funzione, non da query GET
        if ($id > 0) {
            $table = FPersistentManager::getInstance()->getTableById($id);
            if ($table) {
                FPersistentManager::getInstance()->deleteTable($table);
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/table/listAll');
        exit;
    }
}