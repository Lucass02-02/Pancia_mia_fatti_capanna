<?php

namespace AppORM\Services\Foundation;
require_once __DIR__ . '/FTable.php';
use AppORM\Services\Foundation\FEntityManager;
use AppORM\Services\Foundation\FClient;
use AppORM\Entity\EClient;
use AppORM\Entity\EUserReview;
use AppORM\Services\Foundation\FUserReview;
use AppORM\Entity\ECreditCard;
use AppORM\Services\Foundation\FCreditCard;
use AppORM\Entity\EProduct;
use AppORM\Services\Foundation\FProduct;
use AppORM\Entity\EAllergens;
use AppORM\Services\Foundation\FAllergens;
use AppORM\Entity\EReservation;
use AppORM\Entity\ERestaurantHall;
use AppORM\Entity\ETable;
use AppORM\Entity\EReservationTable;
use AppORM\Entity\DayOfWeek; // Ensure this line is present and correct
use AppORM\Services\Foundation\FTurn;
use \DateTime;
use AppORM\Services\Foundation\FReservation;
use AppORM\Entity\ReservationStatus;
use AppORM\Entity\TableState;
use AppORM\Services\Foundation\FOrder;
use AppORM\Entity\EOrder;
use AppORM\Entity\OrderStatus;
use AppORM\Entity\EProductCategory; 
use AppORM\Services\Foundation\FProductCategory;
use AppORM\Entity\EAdmin;
use AppORM\Services\Foundation\FAdmin;
use AppORM\Services\Foundation\FTable;
use AppORM\Entity\EWaiter;
use AppORM\Services\Foundation\FWaiter;

class FPersistentManager {

    private static $instance;

    private function __construct() {
       
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function uploadObject($object) {
        $result = FEntityManager::getInstance()->saveObject($object);
        return $result;
    }

    public static function registerClient(string $name, string $surname, DateTime $birthDate, string $email, string $password,  ?string $phoneNumber = null, ?string $nickname = null,): ?EClient {
        if (FClient::getClientByEmail($email) !== null) { return null; }
        if ($nickname !== null && FClient::getClientByNickname($nickname) !== null) { return null; }
        $client = new EClient($name, $surname, $birthDate, $email, password_hash($password, PASSWORD_DEFAULT), $phoneNumber, $nickname);
        $client->setNickname($nickname);
        $client->setPhonenumber($phoneNumber);
        if (FClient::saveObj($client)) { return $client; }
        return null;
    }
    
    public static function authenticateClient(string $email, string $password): ?EClient {
        $client = FClient::getClientByEmail($email);
        if ($client && password_verify($password, $client->getPassword())) { return $client; }
        return null;
    }
    
    // --- Metodi di recupero e aggiornamento mantenuti per fornire un'API completa ---
    
    public static function getClientById(int $id): ?EClient { return FClient::getObj($id); }
    
    public static function getClientByEmail(string $email): ?EClient { return FClient::getClientByEmail($email); }
    
    public static function updateClientPhonenumber(EClient $client, ?string $newPhoneNumber): bool { return FClient::setPhonenumber($client, $newPhoneNumber); }
    
    public static function updateClientNickname(EClient $client, ?string $newNickname): bool { return FClient::setNickname($client, $newNickname); }
    
    public static function updateClientReceivesNotifications(EClient $client, bool $status): bool { return FClient::setReceivesNotifications($client, $status); }
    
    public static function addClientLoyaltyPoints(EClient $client, int $pointsToAdd): bool { $newPoints = $client->getLoyaltyPoints() + $pointsToAdd; return FClient::setLoyaltyPoints($client, $newPoints); }
    
    public static function removeClientLoyaltyPoints(EClient $client, int $pointsToRemove): bool { $newPoints = max(0, $client->getLoyaltyPoints() - $pointsToRemove); return FClient::setLoyaltyPoints($client, $newPoints); }

    public static function addReviewToClient(EClient $client, string $comment, int $rating): bool
    {
        try {
            $review = new EUserReview($client, $comment, $rating);
            return FUserReview::saveObj($review);
        } catch (\Exception $e) {
            error_log("Errore durante il salvataggio della recensione: " . $e->getMessage());
            return false;
        }
    }
    /**
     * Recupera tutte le recensioni dal database.
     * @return array
     */
    public static function getAllReviews(): array
    {
        return FUserReview::fetchAll();
    }

    public static function addCreditCardToClient(EClient $client, string $brand, string $last4, int $expMonth, int $expYear, ?string $cardName): bool
    {
        try {
            $paymentToken = 'pm_' . bin2hex(random_bytes(12));
            $creditCard = new ECreditCard($client, $paymentToken, $brand, $last4, $expMonth, $expYear, $cardName);
            return FCreditCard::saveObj($creditCard);
        } catch (\Exception $e) {
            error_log("Errore durante il salvataggio della carta: " . $e->getMessage());
            return false;
        }
    }
    
    public static function getClientCreditCards(EClient $client): array { 
        return $client->getCreditCards()->toArray();
     }
    
    public static function deleteCreditCard(int $cardId): bool
    {
        try {
            $creditCard = FEntityManager::getInstance()->retriveObject(ECreditCard::class, $cardId);
            if ($creditCard) {
                return FEntityManager::getInstance()->deleteObject($creditCard);
            }
            return false;
        } catch (\Exception $e) {
            error_log("Errore durante la cancellazione della carta: " . $e->getMessage());
            return false;
        }
    }
    
    public static function deleteClient(EClient $client): bool { return FClient::deleteObj($client); }
    
    // --- Metodi di gestione Prodotti e Allergeni mantenuti per il Proprietario ---
    
    public static function saveProduct(EProduct $product): bool { return FProduct::saveObj($product); }
    
    public static function getProductById(int $id): ?EProduct { return FProduct::getObj($id); }

    public static function getAllProducts(): array
    {
        return FProduct::fetchAll();
    }
    
    public static function updateProductAvailability(EProduct $product, bool $availability): bool { return FProduct::setAvailability($product, $availability); }
    
    public static function deleteProduct(EProduct $product): bool { return FProduct::deleteObj($product); }
    
    public static function saveAllergen(EAllergens $allergen): bool { return FAllergens::saveObj($allergen); }
    
    public static function getAllergenById(int $id): ?EAllergens { return FAllergens::getAllergenById($id); }

    public static function getAllAllergens(): array
    {
        return FAllergens::fetchAll();
    }
    
    public static function deleteAllergen(EAllergens $allergen): bool { return FAllergens::deleteObj($allergen); }
    
    public static function addAllergenToProduct(EProduct $product, EAllergens $allergen): bool { $product->addAllergen($allergen); return FProduct::saveObj($product); }
    
    public static function removeAllergenFromProduct(EProduct $product, EAllergens $allergen): bool { $product->removeAllergen($allergen); return FProduct::saveObj($product); }
    
    /**
     * Salva o aggiorna una categoria di prodotti.
     */
    public static function saveProductCategory(EProductCategory $category): bool 
    { 
        return FProductCategory::saveObj($category); 
    }
    
    /**
     * Recupera una categoria tramite ID.
     */
    public static function getProductCategoryById(int $id): ?EProductCategory 
    { 
        return FProductCategory::getObj($id); 
    }

    /**
     * Recupera tutte le categorie di prodotti.
     */
    public static function getAllProductCategories(): array
    {
        return FProductCategory::selectAll();
    }
    
    /**
     * Cancella una categoria di prodotti.
     */
    public static function deleteProductCategory(EProductCategory $category): bool 
    { 
        return FProductCategory::deleteObj($category); 
    }

    /**
     * Aggiorna il nome di una categoria esistente.
     */
    public static function updateProductCategoryName(EProductCategory $category, string $newName): bool
    {
        $category->setName($newName);
        return FProductCategory::saveObj($category);
    }

    //Funzione che crea una prenotazione, passi in ingeresso solo l'oggetto reservation e l'associazione al client la fai nel controllore
    //mentre l'associazione al tavolo e al turno viene fatta nella funzione
    public static function createReservation(EReservation $reservation){
        //costanti per gestire la durata dinamica della prenotazione 
        $defaultDuration = 90;
        $minDuration = 60;
        $maxDuration = 180;

        $date = $reservation->getDate();
        
        $dayOfWeek = DayOfWeek::fromDate($date);

        $turn = FTurn::getTurnByDayOfTheWeek($dayOfWeek);

        $turn = FTurn::determineTurnByTime($reservation->getHours());

        if (!$turn) {
            return [
                'status' => 'error',
                'message' => "Orario non valido per nessun turno."
            ];
        }

      
        $reservation->setTurn($turn);

        $time = $reservation->getHours();
        
        $duration = $reservation->getDuration();
        //$turn = FEntityManager::getInstance()->retriveObject(ETurn::getEntity(), $reservation->getTurn()->getIdTurn());
        $hall = FEntityManager::getInstance()->retriveObject(ERestaurantHall::getEntity(), $reservation->getRestaurantHall()->getIdHall()); 

    
        //se non è specificata una durata assegna una di default
        if(!$duration) {
            $duration = $defaultDuration;
            $reservation->setDuration($duration);
        }

        if ($duration < $minDuration || $duration > $maxDuration) {
            return [
                'status' => 'error',
                'message' => "La durata della prenotazione deve essere compresa tra $minDuration e $maxDuration minuti."
            ];
        }

        
        // tutto questo per assegnare la data ai turni che non la hanno
        $timeStart = \DateTime::createFromFormat('Y-m-d H:i:s', $date->format('Y-m-d') . ' ' .  $time->format('H:i:s'));

        $endTime = (clone $timeStart)->modify("+$duration minutes");
        
        $reservationDate = $timeStart->format('Y-m-d');

        $turnStart = \DateTime::createFromFormat('Y-m-d H:i:s', $reservationDate . ' ' . $turn->getStartTime()->format('H:i:s'));

        $turnEnd = \DateTime::createFromFormat('Y-m-d H:i:s', $reservationDate . ' ' . $turn->getEndTime()->format('H:i:s'));

        $maxEndTime = (clone $turnEnd)->modify("+30 minutes");

        if ($timeStart < $turnStart) {
            return [
                'status' => 'error',
                'message' => "L'orario di inizio della prenotazione non può essere prima dell'orario di inizio del turno."
            ];
        }

        if ($endTime > $maxEndTime) {
            return [
                'status' => 'error',
                'message' => "L'orario di fine della prenotazione non può superare l'orario di fine del turno."
            ];
        }

        //$tables = FEntityManager::getInstance()->retriveObjectList(ETable::getEntity(), 'restaurantHall', $hall->getIdHall());
        
        try {
            $tables = FEntityManager::getInstance()->selectAll(ETable::getEntity());
            echo "✅ Chiamata riuscita, tavoli caricati\n";
        } catch (\Exception $e) {
            echo "❌ ERRORE durante il recupero dei tavoli: " . $e->getMessage() . "\n";
            
        }

        $people = $reservation->getPeopleNum();
        $availableTables = [];   

        foreach ($tables as $table) {
            $conflict = false;
            
            $existingReservations = FReservation::getReservationsForTableOnDate($table, $reservation->getDate());

            foreach ($existingReservations as $existing) {
                if (!in_array($existing->getStatus(), [ReservationStatus::CREATED, ReservationStatus::APPROVED, ReservationStatus::ORDER_IN_PROGRESS, ReservationStatus::ORDER_COMPLETED])) {
                    continue; 
                }
                $existingStart = $existing->getHours();
                $existingEnd = (clone $existingStart)->modify("+" . $existing->getDuration() . " minutes");
                
                if (
                    ($time >= $existingStart && $time < $existingEnd) ||
                    ($endTime > $existingStart && $endTime <= $existingEnd) ||
                    ($time < $existingStart && $endTime > $existingEnd)
                ) {
                    $conflict = true;
                    break;
                }
            }

            if (!$conflict) {
                $availableTables[] = $table;
            }
        }

        usort($availableTables, fn($a, $b) => $a->getSeatsNumber() <=> $b->getSeatsNumber());

        $assignedTables = [];
        $seatsAccumulated = 0;

        foreach ($availableTables as $table) {
            $assignedTables[] = $table;
            $seatsAccumulated += $table->getSeatsNumber();
            if ($seatsAccumulated >= $people) {
                break;
            }
        }

        if ($seatsAccumulated < $people) {
            return [
                'status' => 'error',
                'message' => "Non ci sono abbastanza posti disponibili per $people persone."
            ];
        }

        
            foreach ($assignedTables as $table) {
                $reservationTable = new EReservationTable();
                $reservationTable->setReservation($reservation);
                $reservationTable->setDate($date);
                $reservationTable->setStartTime($timeStart);
                $reservationTable->setEndTime($endTime);
                $reservationTable->setTable($table);
                self::uploadObject($reservationTable);

                $reservation->addTableReservation($reservationTable);
                //$reservation->addTable($table);
                $table->setState(TableState::RESERVED);
                self::uploadObject($table);
            } 
        
        self::uploadObject($reservation);
        
        return [
            'status' => 'success',
            'message' => "Prenotazione creata con successo.",
            'tables' => array_map(fn($t) => $t->getIdTable(), $assignedTables)
        ];

    }


    public static function createOrderFromReservation(EReservation $reservation) {
        if ($reservation->getStatus() == ReservationStatus::CREATED) {
            
            $reservation->setStatus(ReservationStatus::APPROVED);
            self::uploadObject($reservation);
            $order = FOrder::createOrder($reservation);
            $results = self::uploadObject($order);
            return $results;
        }
    }


    public static function deleteReservation(EReservation $reservation) {
        if ($reservation->getStatus() == ReservationStatus::CREATED) {
            
            $tables = $reservation->getTable();
           
            foreach ($tables as $table) {
                $table->setState(TableState::AVAILABLE);
                self::uploadObject($table);
            }
            $reservation->setStatus(ReservationStatus::CANCELED);
            $results = self::uploadObject($reservation);
            return $results;

        } else {
            return [
                'status' => 'error',
                'message' => "La prenotazione non può essere cancellata perché non è nello stato 'CREATED'."
            ];
        }
    }

    public static function unlockOrder(EOrder $order) {
       $reservation = $order->getReservation();
       
       if ($reservation->getStatus() == ReservationStatus::APPROVED) {
            $reservation->setStatus(ReservationStatus::ORDER_IN_PROGRESS);
            self::uploadObject($reservation);
            $order->setStatus(OrderStatus::IN_PROGRESS);
            $results = self::uploadObject($order);
            return $results;
        } else {
            return [
                'status' => 'error',
                'message' => "L'ordine non può essere sbloccato perché la prenotazione non è nello stato 'APPROVED'."
            ];
        }

    }

    public static function confirmOrder(EOrder $order) {
        $reservation = $order->getReservation();
        
        if ($reservation->getStatus() == ReservationStatus::ORDER_IN_PROGRESS) {
            $reservation->setStatus(ReservationStatus::ORDER_COMPLETED);
            self::uploadObject($reservation);
            $order->setStatus(OrderStatus::PAID);
            $results = self::uploadObject($order);
            return $results;
        } else {
            return [
                'status' => 'error',
                'message' => "L'ordine non può essere confermato perché la prenotazione non è nello stato 'ORDER_IN_PROGRESS'."
            ];
        }
    }

    public static function getOrderSummaryForReservation(EReservation $reservation) {
        $order = FReservation::getOrderByReservation($reservation);
        $reservation->setStatus(ReservationStatus::ENDED);
        self::uploadObject($reservation);
        return [
            'items' => $order->getOrderItems(),
            'total' => FOrder::calculateTotalPrice($order),
        ];
    }

    public static function getEntityManager()
    {
        // Questo metodo semplicemente inoltra la richiesta a FEntityManager,
        // che è l'unico a dover conoscere l'istanza di Doctrine.
        return FEntityManager::getInstance()->getEntityManager();
    }
    public static function authenticateAdmin(string $email, string $password): ?EAdmin  {
        $admin = FAdmin::getAdminByEmail($email);
        // Se l'admin esiste e la password è corretta, restituisce l'oggetto admin
        if ($admin && password_verify($password, $admin->getPassword())) {
            return $admin;
        }
        // Altrimenti restituisce null
        return null;
    }
    /**
     * Recupera solo i prodotti disponibili per la visualizzazione ai clienti.
     */
    public static function getAvailableProducts(): array
    {
        return FProduct::getAvailableProducts();
    }

     public static function getAdminById(int $id): ?\AppORM\Entity\EAdmin
    {
        return FEntityManager::getInstance()->retriveObject(\AppORM\Entity\EAdmin::class, $id);
    }

     /**
     * Salva o aggiorna un tavolo.
     * Chiama il metodo aggiunto a FTable.
     */
    public static function saveTable(ETable $table): bool {
        // La \ iniziale è necessaria perché FTable non ha un namespace
        return \FTable::save($table);
    }

    /**
     * Recupera un tavolo tramite il suo ID.
     * Chiama il tuo metodo esistente in FTable.
     */
    public static function getTableById(int $id): ?ETable {
        return \FTable::getTableById($id);
    }

    /**
     * Cancella un tavolo.
     * Chiama il metodo aggiunto a FTable.
     */
    public static function deleteTable(ETable $table): bool {
        return \FTable::delete($table);
    }

    /**
     * Recupera tutti i tavoli.
     * Chiama il metodo aggiunto a FTable.
     */
    public static function getAllTables(): array {
        return \FTable::getAllTables();
    }

    /**
     * Recupera tutte le sale del ristorante.
     */
    public static function getAllRestaurantHalls(): array {
        return FEntityManager::getInstance()->selectAll(\AppORM\Entity\ERestaurantHall::class);
    }

    /**
     * Recupera una sala tramite ID.
     */
    public static function getRestaurantHallById(int $id): ?\AppORM\Entity\ERestaurantHall {
        return FEntityManager::getInstance()->retriveObject(\AppORM\Entity\ERestaurantHall::class, $id);
    }

        /**
     * Salva un'entità ERestaurantHall nel database.
     * @param \AppORM\Entity\ERestaurantHall $hall
     */
    public function saveRestaurantHall(\AppORM\Entity\ERestaurantHall $hall): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($hall);
        $entityManager->flush();
    }

    /**
     * Elimina un'entità ERestaurantHall dal database.
     * @param \AppORM\Entity\ERestaurantHall $hall
     */
    public function deleteRestaurantHall(\AppORM\Entity\ERestaurantHall $hall): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($hall);
        $entityManager->flush();
    }



    public static function getWaiterById(int $id): ?EWaiter {
        return FWaiter::getObj($id);
    }

    public static function getAllWaiters(): array {
        return FWaiter::selectAll();
    }

    public static function deleteWaiter(int $id): bool {
        $waiter = self::getWaiterById($id);
        if ($waiter) {
            return FWaiter::deleteObj($waiter);
        }
        return false;
    }
    public static function getAllClients(): array
    {
        return FEntityManager::getInstance()->selectAll(\AppORM\Entity\EClient::class);
    }

    public static function getWaiterByEmail(string $email): ?EWaiter
    {
        return FWaiter::getWaiterByEmail($email);
    }

    public static function registerWaiter(string $name, string $surname, DateTime $birthDate, string $email, string $password, string $serialNumber, int $hallId): ?EWaiter
    {
        // Ora questa chiamata funziona perché il metodo esiste in questa classe
        if (self::getWaiterByEmail($email)) { return null; }
        
        $hall = self::getRestaurantHallById($hallId);
        if (!$hall) { return null; }

        $waiter = new EWaiter($name, $surname, $birthDate, $email, password_hash($password, PASSWORD_DEFAULT), $serialNumber);
        $waiter->setRestaurantHall($hall);

        if (FWaiter::saveObj($waiter)) {
            return $waiter;
        }
        return null;
    }

    public static function authenticateWaiter(string $email, string $password): ?EWaiter
    {
        $waiter = FWaiter::getWaiterByEmail($email);
        if ($waiter && password_verify($password, $waiter->getPassword())) {
            return $waiter;
        }
        return null;
    }
      public static function saveWaiter(EWaiter $waiter): bool
    {
        return FWaiter::saveObj($waiter);
    }

}