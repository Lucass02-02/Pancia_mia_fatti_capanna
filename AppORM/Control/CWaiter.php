<?php
// File: AppORM/Control/CWaiter.php 
namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\USession;
use AppORM\Services\Utility\UView;
use AppORM\Entity\TableState;
use DateTime;

class CWaiter
{
    /**
     * Controlla se l'utente è un admin, altrimenti lo reindirizza.
     */
    private static function checkAdmin(): void {
        if (USession::getValue('user_role') !== 'admin') {
            header('Location: /Pancia_mia_fatti_capanna/');
            exit;
        }
    }

    // --- FUNZIONI RISERVATE AL PROPRIETARIO (ADMIN) ---

    /**
     * Mostra la pagina di gestione dei camerieri.
     * Carica tutti i camerieri e tutte le sale dal database.
     */
    public static function manage(): void
    {
        self::checkAdmin();
        
        $waiters = FPersistentManager::getInstance()->getAllWaiters();
        $halls = FPersistentManager::getInstance()->getAllRestaurantHalls();
        
        UView::render('manage_waiters', ['waiters' => $waiters, 'halls' => $halls]);
    }

    /**
     * Gestisce la registrazione di un nuovo cameriere.
     */
    public static function register(): void
    {
        self::checkAdmin();
        
        if (UHTTPMethods::isPost()) {
            $name = UHTTPMethods::getPostValue('name');
            $surname = UHTTPMethods::getPostValue('surname');
            $email = UHTTPMethods::getPostValue('email');
            $password = UHTTPMethods::getPostValue('password');
            $birthDate = new DateTime(UHTTPMethods::getPostValue('birthDate'));
            $serialNumber = UHTTPMethods::getPostValue('serialNumber');
            $hallId = (int)UHTTPMethods::getPostValue('hall_id');

            FPersistentManager::getInstance()->registerWaiter($name, $surname, $birthDate, $email, $password, $serialNumber, $hallId);
        }
        // URL pulito
        header('Location: /Pancia_mia_fatti_capanna/waiter/manage');
        exit;
    }

    /**
     * Cancella un cameriere.
     * Modificato per accettare l'ID come segmento dell'URL.
     */
    public static function delete(int $id): void
    {
        self::checkAdmin();
        // L'ID viene passato come parametro della funzione, non da query GET
        if ($id > 0) {
            FPersistentManager::getInstance()->deleteWaiter($id);
        }
        
        // URL pulito
        header('Location: /Pancia_mia_fatti_capanna/waiter/manage');
        exit;
    }

    /**
     * Aggiorna la sala assegnata a un cameriere.
     */
    public static function updateHall(): void
    {
        self::checkAdmin();

        if (UHTTPMethods::isPost()) {
            $waiterId = (int)UHTTPMethods::getPostValue('waiter_id');
            $hallId = (int)UHTTPMethods::getPostValue('hall_id');

            $waiter = FPersistentManager::getInstance()->getWaiterById($waiterId);
            $hall = FPersistentManager::getInstance()->getRestaurantHallById($hallId);

            if ($waiter && $hall) {
                $waiter->setRestaurantHall($hall);
                FPersistentManager::getInstance()->saveWaiter($waiter);
            }
        }
        // URL pulito
        header('Location: /Pancia_mia_fatti_capanna/waiter/manage');
        exit;
    }


    // --- FUNZIONI RISERVATE AL CAMERIERE LOGGATO ---

    /**
     * Mostra la pagina del profilo/dashboard del cameriere.
     */
    public static function profile(): void
    {
        if (USession::getValue('user_role') !== 'waiter') {
            header('Location: /Pancia_mia_fatti_capanna/');
            exit;
        }
        
        $waiterId = USession::getValue('user_id');
        $waiter = FPersistentManager::getInstance()->getWaiterById($waiterId);

        if ($waiter) {
            UView::render('waiter_profile', ['waiter' => $waiter]);
        } else {
            CClient::logout();
        }
    }

    /**
     * Mostra lo stato dei tavoli della sala del cameriere.
     */
    public static function viewTables(): void
    {
        if (USession::getValue('user_role') !== 'waiter') { header('Location: /Pancia_mia_fatti_capanna/'); exit; }

        $waiterId = USession::getValue('user_id');
        $waiter = FPersistentManager::getInstance()->getWaiterById($waiterId);

        if ($waiter) {
            $hall = $waiter->getRestaurantHall();
            // Assicurati che getTables() sia lazy-loaded o recuperi i tavoli correttamente
            $tablesInHall = $hall->getTables(); 
            
            UView::render('waiter_tables_view', ['tables' => $tablesInHall, 'hall' => $hall]);
        } else {
            CClient::logout();
        }
    }

    /**
     * Permette a un cameriere di aggiornare lo stato di un tavolo.
     */
    public static function updateTableState(): void
    {
        if (USession::getValue('user_role') !== 'waiter') { header('Location: /Pancia_mia_fatti_capanna/'); exit; }

        if (UHTTPMethods::isPost()) {
            $tableId = (int)UHTTPMethods::getPostValue('table_id');
            $newState = UHTTPMethods::getPostValue('state');
            
            $waiterId = USession::getValue('user_id');
            $waiter = FPersistentManager::getInstance()->getWaiterById($waiterId);
            $table = FPersistentManager::getInstance()->getTableById($tableId);

            if ($waiter && $table && $newState) {
                // Controllo di sicurezza: il cameriere può modificare solo tavoli della sua sala.
                if ($table->getRestaurantHall()->getIdHall() == $waiter->getRestaurantHall()->getIdHall()) {
                    try {
                        $stateEnum = TableState::from($newState);
                        $table->setState($stateEnum);
                        FPersistentManager::getInstance()->saveTable($table);
                    } catch (\ValueError $e) {
                        // Lo stato inviato non è valido, non fare nulla.
                    }
                }
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/waiter/viewTables');
        exit;
    }
}