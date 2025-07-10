<?php
// File: AppORM/Control/CWaiter.php
namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\USession;
use AppORM\Services\Utility\UView;
use AppORM\Entity\TableState;
use AppORM\Entity\EWaiter; // Assicurati di importare l'entità EWaiter
use DateTime;

class CWaiter
{
    private static function checkAdmin(): void {
        if (USession::getValue('user_role') !== 'admin') {
            header('Location: /Pancia_mia_fatti_capanna/');
            exit;
        }
    }

    // --- FUNZIONI RISERVATE AL PROPRIETARIO (ADMIN) ---

    public static function manage(): void
    {
        self::checkAdmin();
        
        $waiters = FPersistentManager::getInstance()->getAllWaiters();
        $halls = FPersistentManager::getInstance()->getAllRestaurantHalls();
        
        UView::render('manage_waiters', ['waiters' => $waiters, 'halls' => $halls]);
    }

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

            // FPersistentManager::getInstance()->registerWaiter ritorna ?EWaiter o null
            $waiter = FPersistentManager::getInstance()->registerWaiter($name, $surname, $birthDate, $email, $password, $serialNumber, $hallId);
            // Qui potresti voler aggiungere una gestione per il successo/fallimento della registrazione
            // ad esempio, un flash message nella sessione
            if (!$waiter) {
                USession::setValue('waiter_management_error', 'Errore durante la registrazione del cameriere. Email o Matricola potrebbero essere già in uso.');
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/waiter/manage');
        exit;
    }

    public static function delete(int $id): void
    {
        self::checkAdmin();
        if ($id > 0) {
            FPersistentManager::getInstance()->deleteWaiter($id);
            // Potresti aggiungere un flash message di successo qui
        }
        header('Location: /Pancia_mia_fatti_capanna/waiter/manage');
        exit;
    }

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
                FPersistentManager::getInstance()->saveWaiter($waiter); // saveWaiter aggiorna il cameriere esistente
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/waiter/manage');
        exit;
    }

    /**
     * Mostra il form per modificare i dati di un cameriere esistente.
     * @param int $id L'ID del cameriere da modificare (passato nell'URL).
     */
    public static function edit(int $id): void
    {
        self::checkAdmin();

        $waiter = FPersistentManager::getInstance()->getWaiterById($id);
        $halls = FPersistentManager::getInstance()->getAllRestaurantHalls();

        if (!$waiter) {
            // Cameriere non trovato, reindirizza con errore o messaggio
            USession::setValue('waiter_management_error', 'Cameriere non trovato per la modifica.');
            header('Location: /Pancia_mia_fatti_capanna/waiter/manage');
            exit;
        }

        UView::render('edit_waiter', [
            'waiter' => $waiter,
            'halls' => $halls
        ]);
    }

    /**
     * Gestisce l'invio del form di modifica dei dati del cameriere.
     * Aggiorna i dati del cameriere nel database.
     */
    public static function update(): void
    {
        self::checkAdmin();

        if (UHTTPMethods::isPost()) {
            $id = (int)UHTTPMethods::getPostValue('id'); // ID del cameriere dal form
            $name = UHTTPMethods::getPostValue('name');
            $surname = UHTTPMethods::getPostValue('surname');
            $email = UHTTPMethods::getPostValue('email');
            $serialNumber = UHTTPMethods::getPostValue('serialNumber');
            $hallId = (int)UHTTPMethods::getPostValue('hall_id');
            $birthDateStr = UHTTPMethods::getPostValue('birthDate');

            $waiter = FPersistentManager::getInstance()->getWaiterById($id);
            $hall = FPersistentManager::getInstance()->getRestaurantHallById($hallId);

            if ($waiter && $hall && $name && $surname && $email && $serialNumber && $birthDateStr) {
                try {
                    $birthDate = new DateTime($birthDateStr);
                    
                    $waiter->setName($name);
                    $waiter->setSurname($surname);
                    $waiter->setEmail($email);
                    $waiter->setSerialNumber($serialNumber);
                    $waiter->setRestaurantHall($hall);
                    $waiter->setBirthDate($birthDate); // Aggiorna la data di nascita

                    // Se viene fornita una nuova password, hashala e impostala
                    $newPassword = UHTTPMethods::getPostValue('password');
                    if (!empty($newPassword)) {
                        $waiter->setPassword(password_hash($newPassword, PASSWORD_DEFAULT));
                    }

                    FPersistentManager::getInstance()->saveWaiter($waiter); // saveWaiter gestisce l'aggiornamento
                    USession::setValue('waiter_management_success', 'Dati cameriere aggiornati con successo!');
                } catch (\Exception $e) {
                    USession::setValue('waiter_management_error', 'Errore durante l\'aggiornamento del cameriere: ' . $e->getMessage());
                    error_log("Error updating waiter: " . $e->getMessage());
                }
            } else {
                USession::setValue('waiter_management_error', 'Tutti i campi obbligatori devono essere compilati.');
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/waiter/manage');
        exit;
    }


    // --- FUNZIONI RISERVATE AL CAMERIERE LOGGATO ---

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

    public static function viewTables(): void
    {
        if (USession::getValue('user_role') !== 'waiter') { header('Location: /Pancia_mia_fatti_capanna/'); exit; }

        $waiterId = USession::getValue('user_id');
        $waiter = FPersistentManager::getInstance()->getWaiterById($waiterId);

        if ($waiter) {
            $hall = $waiter->getRestaurantHall();
            $tablesInHall = $hall->getTables(); 
            
            UView::render('waiter_tables_view', ['tables' => $tablesInHall, 'hall' => $hall]);
        } else {
            CClient::logout();
        }
    }

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