<?php
// File: AppORM/Control/CWaiter.php
namespace AppORM\Control;

use AppORM\Entity\EOrder;
use AppORM\Entity\EOrderItem;
use AppORM\Entity\EReservation;
use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\USession;
use AppORM\Services\Utility\UView;
use AppORM\Entity\TableState;
use AppORM\Entity\EWaiter; // Assicurati di importare l'entità EWaiter
use AppORM\Entity\OrderStatus;
use AppORM\Services\Foundation\FEntityManager;
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
        
        // Gestione dei messaggi di feedback per la vista
        $error = USession::getValue('waiter_management_error');
        if ($error) {
            USession::unsetValue('waiter_management_error');
        }

        $success = USession::getValue('waiter_management_success');
        if ($success) {
            USession::unsetValue('waiter_management_success');
        }
        
        UView::render('manage_waiters', [
            'waiters' => $waiters, 
            'halls' => $halls,
            'error' => $error,
            'success' => $success
        ]);
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
            $phoneNumber = UHTTPMethods::getPostValue('phoneNumber');
            $hallId = (int)UHTTPMethods::getPostValue('hall_id');

            // --- VALIDAZIONE NUMERO DI TELEFONO ---
            if (!empty($phoneNumber) && !ctype_digit($phoneNumber)) {
                USession::setValue('waiter_management_error', 'Errore: Il numero di telefono può contenere solo cifre numeriche (0-9).');
                header('Location: /Pancia_mia_fatti_capanna/waiter/manage');
                exit;
            }
            // --- FINE VALIDAZIONE ---

            $pm = FPersistentManager::getInstance();
            $errorFound = false;

            if ($pm->getAdminByEmail($email)) {
                USession::setValue('waiter_management_error', 'Errore: L\'email fornita è già in uso da un amministratore.');
                $errorFound = true;
            } elseif ($pm->getClientByEmail($email)) {
                USession::setValue('waiter_management_error', 'Errore: L\'email fornita è già in uso da un cliente.');
                $errorFound = true;
            } elseif ($pm->getWaiterByEmail($email)) {
                USession::setValue('waiter_management_error', 'Errore: L\'email fornita è già in uso da un altro cameriere.');
                $errorFound = true;
            }

            if (!$errorFound && $pm->getWaiterBySerialNumber($serialNumber)) {
                USession::setValue('waiter_management_error', 'Errore: La matricola fornita è già in uso da un altro cameriere.');
                $errorFound = true;
            }

            if (!$errorFound) {
                $waiter = $pm->registerWaiter($name, $surname, $birthDate, $email, $password,  $phoneNumber, $serialNumber, $hallId);
                
                if ($waiter) {
                    USession::setValue('waiter_management_success', 'Cameriere registrato con successo!');
                } else {
                    USession::setValue('waiter_management_error', 'Errore imprevisto durante la registrazione del cameriere.');
                }
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

    public static function viewReservation() {
        if (USession::getValue('user_role') !== 'waiter') {
             header('Location: /Pancia_mia_fatti_capanna/'); 
             exit;
        }

        $filterDate = UHTTPMethods::getPostValue('filter_date');
        if ($filterDate) {
            UHTTPMethods::setPostValue('filter_date', null);
        }

        if ($filterDate) {

            $reservations = FEntityManager::getInstance()->retriveObjectList(EReservation::class, 'date', $filterDate);
        } else {
            $reservations = FEntityManager::getInstance()->selectAll(EReservation::class);
        }
        

        UView::render('waiter_reservation_view', ['reservations' => $reservations, 'filter_date' => $filterDate]);
    }

    public static function viewOrder() {
        if (USession::getValue('user_role') !== 'waiter') {
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
        if (USession::getValue('user_role') !== 'waiter') {
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
            header('Location: /Pancia_mia_fatti_capanna/Waiter/viewOrder');
            exit;
        }else{
            USession::setValue('flash_message', $result);
            header('Location: /Pancia_mia_fatti_capanna/Waiter/viewOrder');
        }

        
    }

    public static function detailOrder() {
        if (USession::getValue('user_role') !== 'waiter') {
             header('Location: /Pancia_mia_fatti_capanna/'); 
             exit;
        }

        $userRole = USession::getValue('user_role');

        $orderId = UHTTPMethods::getPostValue('order_id');

        $order_items = FEntityManager::getInstance()->retriveObjectList(EOrderItem::class, 'order', $orderId);

        UView::render('waiter_order_detail', ['order_items' => $order_items, 'user_role' => $userRole]);
    }
}