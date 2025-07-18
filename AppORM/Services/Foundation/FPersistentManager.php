<?php
namespace AppORM\Services\Foundation;
require_once __DIR__ . '/../../../bootstrap.php';
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
use AppORM\Entity\DayOfWeek; 
use AppORM\Services\Foundation\FTurn;
use \DateTime;
use AppORM\Services\Foundation\FReservation;
use AppORM\Entity\ReservationStatus;
use AppORM\Entity\TableState;
use AppORM\Services\Foundation\FOrder;
use AppORM\Entity\EOrder;
use AppORM\Entity\OrderStatus;
use AppORM\Entity\EAdmin;
use AppORM\Services\Foundation\FAdmin;
use AppORM\Services\Foundation\FTable;
use AppORM\Entity\EWaiter;
use AppORM\Entity\EProductCategory;
use AppORM\Entity\EAdminResponse;
use Exception;


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
        if (FClient::getClientByEmail($email) !== null) {
             return null;
             }
        if ($nickname !== null && FClient::getClientByNickname($nickname) !== null) {
             return null; 
            }
        $client = new EClient($name, $surname, $birthDate, $email, password_hash($password, PASSWORD_DEFAULT), $phoneNumber, $nickname);
        $client->setNickname($nickname);
        $client->setPhonenumber($phoneNumber);
        if (FClient::saveObj($client)) {
             return $client; 
            }
        return null;
    }
    
    public static function authenticateClient(string $email, string $password): ?EClient {
        $client = FClient::getClientByEmail($email);
        if ($client && password_verify($password, $client->getPassword())) {
             return $client; 
            }
        return null;
    }
    
    
    public static function getClientById(int $id): ?EClient {
         return FClient::getObj($id); 
    }
    
    public static function getClientByEmail(string $email): ?EClient {
         return FClient::getClientByEmail($email); 
    }
    
    public static function updateClientPhonenumber(EClient $client, ?string $newPhoneNumber): bool {
         return FClient::setPhonenumber($client, $newPhoneNumber); 
    }
    
    public static function updateClientNickname(EClient $client, ?string $newNickname): bool {
         return FClient::setNickname($client, $newNickname); 
    }
    
    public static function updateClientReceivesNotifications(EClient $client, bool $status): bool {
         return FClient::setReceivesNotifications($client, $status); 
    }

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
    
    public static function deleteClient(EClient $client): bool {
         return FClient::deleteObj($client); 
        }
    
    // --- Metodi di gestione Prodotti e Allergeni mantenuti per il Proprietario ---
    
    public static function saveProduct(EProduct $product): bool {
         return FProduct::saveObj($product); 
    }
    
    public static function getProductById(int $id): ?EProduct {
         return FProduct::getObj($id); 
    }

    public static function getAllProducts(): array
    {
        return FProduct::fetchAll();
    }
    
    public static function updateProductAvailability(EProduct $product, bool $availability): bool {
         return FProduct::setAvailability($product, $availability); 
    }
    
    public static function deleteProduct(EProduct $product): bool {
         return FProduct::deleteObj($product); 
    }
    
    public static function saveAllergen(EAllergens $allergen): bool {
         return FAllergens::saveObj($allergen); 
    }
    
    public static function getAllergenById(int $id): ?EAllergens {
         return FAllergens::getAllergenById($id); 
    }

    public static function getAllAllergens(): array
    {
        return FAllergens::fetchAll();
    }
    
    public static function deleteAllergen(EAllergens $allergen): bool {
         return FAllergens::deleteObj($allergen); 
    }
    
    public static function addAllergenToProduct(EProduct $product, EAllergens $allergen): bool {
         $product->addAllergen($allergen); return FProduct::saveObj($product); 
    }
    
    public static function removeAllergenFromProduct(EProduct $product, EAllergens $allergen): bool {
         $product->removeAllergen($allergen); return FProduct::saveObj($product); 
    }
    
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
        $maxDuration = 120;

        $date = $reservation->getDate();
        
        $dayOfWeek = DayOfWeek::fromDate($date);

        $turns = FTurn::getTurnByDayOfTheWeek($dayOfWeek);

        $turn = FTurn::determineTurnByTime($turns, $reservation->getHours());

        if (!$turn) {
            return "Orario non valido per nessun turno.";
        }

      
        $reservation->setTurn($turn);

        $time = $reservation->getHours();
        
        $duration = $reservation->getDuration(); 
    
        //se non è specificata una durata assegna una di default
        if(!$duration) {
            $duration = $defaultDuration;
            $reservation->setDuration($duration);
        }

        if ($duration < $minDuration || $duration > $maxDuration) {
            return "La durata della prenotazione deve essere compresa tra $minDuration e $maxDuration minuti.";
        }

        
        // tutto questo per assegnare la data ai turni che non la hanno
        $timeStart = \DateTime::createFromFormat('Y-m-d H:i:s', $date->format('Y-m-d') . ' ' .  $time->format('H:i:s'));

        $endTime = (clone $timeStart)->modify("+$duration minutes");
        
        $reservationDate = $timeStart->format('Y-m-d');

        $turnStart = \DateTime::createFromFormat('Y-m-d H:i:s', $reservationDate . ' ' . $turn->getStartTime()->format('H:i:s'));

        $turnEnd = \DateTime::createFromFormat('Y-m-d H:i:s', $reservationDate . ' ' . $turn->getEndTime()->format('H:i:s'));

        $maxEndTime = (clone $turnEnd)->modify("+30 minutes");

        if ($timeStart < $turnStart) {
            return "L'orario di inizio della prenotazione non può essere prima dell'orario di inizio del turno.";
        }

        if ($endTime > $maxEndTime) {
            return "L'orario di fine della prenotazione non può superare l'orario di fine del turno.";
        }

        $tables = FEntityManager::getInstance()->selectAll(ETable::getEntity());

        $people = $reservation->getPeopleNum();
        $availableTables = [];   

        foreach ($tables as $table) {
            $conflict = false;
            
            $existingReservations = FReservation::getReservationsForTableOnDate($table, $reservation->getDate());

            foreach ($existingReservations as $existing) {
                if (!in_array($existing->getStatus(), [ReservationStatus::CREATED, ReservationStatus::APPROVED, ReservationStatus::ORDER_IN_PROGRESS])) {
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
        $atLeastOneAssigned = false;

        foreach ($availableTables as $table) {
            $conflictFound = false;

            $allReservationTable = FEntityManager::getInstance()->selectAll(EReservationTable::class);

            foreach ($allReservationTable as $singleReservationTable) {
                $dateMatch = $singleReservationTable->getDate()->format('Y-m-d') === $date->format('Y-m-d');
                $tableMatch = $singleReservationTable->getTable()->getIdTable() === $table->getIdTable();

                $existingStart = $singleReservationTable->getStartTime()->format('H:i:s');
                $existingEnd = $singleReservationTable->getEndTime()->format('H:i:s');

                if (
                    $tableMatch && $dateMatch &&
                    ($timeStart->format('H:i:s') < $existingEnd && $endTime->format('H:i:s') > $existingStart)
                ) {
                    $conflictFound = true;
                    break;
                }
            }

            if ($conflictFound) {
                continue; // Salta al prossimo tavolo
            }

            // Se qui, il tavolo è libero
            $reservationTable = new EReservationTable();
            $reservationTable->setReservation($reservation);
            $reservationTable->setDate($date);
            $reservationTable->setStartTime($timeStart);
            $reservationTable->setEndTime($endTime);
            $reservationTable->setTable($table);

            self::uploadObject($reservationTable);
            $reservation->addTableReservation($reservationTable);

            $table->setState(TableState::RESERVED);
            self::uploadObject($table);


            $assignedTables[] = $table;
            $seatsAccumulated += $table->getSeatsNumber();
            $atLeastOneAssigned = true;

            if ($seatsAccumulated >= $reservation->getPeopleNum()) {
                break;
            }
        }

        if (!$atLeastOneAssigned || $seatsAccumulated < $reservation->getPeopleNum()) {
            return "Non ci sono tavoli liberi per quest'orario o non bastano i posti.";
        }

        self::uploadObject($reservation);
        return true;
    }


    public static function createOrderFromReservation(EReservation $reservation) {
        if ($reservation->getStatus() == ReservationStatus::APPROVED) {
            
            $order = FOrder::createOrder($reservation);
            $results = self::uploadObject($order);
            return $results;
        }
    }


    public static function deleteReservation(EReservation $reservation) {
        if ($reservation->getStatus() === ReservationStatus::CANCELED || $reservation->getStatus() === ReservationStatus::ENDED) {
            
            $reservationTables = $reservation->getTable();
           
            foreach ($reservationTables as $reservationTable) {
                $table = $reservationTable->getTable();
                $table->setState(TableState::AVAILABLE);
                self::uploadObject($table);   
            }
            return true;

        } else {
            return "La prenotazione non può essere cancellata perché non è nello stato 'CANCELED'.";
        }
    }
    
    public static function unlockOrder(EOrder $order) {
       $reservation = $order->getReservation();
       
       if ($reservation->getStatus() == ReservationStatus::APPROVED) {
            $reservation->setStatus(ReservationStatus::ORDER_IN_PROGRESS);
            self::uploadObject($reservation);
            $order->setStatus(OrderStatus::IN_PROGRESS);
            self::uploadObject($order);
            return true;
        } else {
            return "L'ordine non può essere sbloccato perché la prenotazione non è nello stato 'APPROVED'.";
        }

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

     public static function getAdminById(int $id): ?EAdmin
    {
        return FEntityManager::getInstance()->retriveObject(EAdmin::class, $id);
    }

     /**
     * Salva o aggiorna un tavolo.
     * Chiama il metodo aggiunto a FTable.
     */
    public static function saveTable(ETable $table): bool {
        // La \ iniziale è necessaria perché FTable non ha un namespace
        return self::uploadObject($table);
    }

    /**
     * Recupera un tavolo tramite il suo ID.
     * Chiama il tuo metodo esistente in FTable.
     */
    public static function getTableById(int $id): ?ETable {
        return FTable::getTableById($id);
    }

    /**
     * Cancella un tavolo.
     * Chiama il metodo aggiunto a FTable.
     */
    public static function deleteTable(ETable $table): bool {
        return FEntityManager::getInstance()->deleteObject($table);
    }

    /**
     * Recupera tutti i tavoli.
     * Chiama il metodo aggiunto a FTable.
     */
    public static function getAllTables(): array {
        return FEntityManager::getInstance()->selectAll(ETable::class);
    }



    /**
     * Recupera tutte le sale del ristorante.
     */
    public static function getAllRestaurantHalls(): array {
        return FEntityManager::getInstance()->selectAll(ERestaurantHall::class);
    }

    /**
     * Recupera una sala tramite ID.
     */
    public static function getRestaurantHallById(int $id): ?ERestaurantHall {
        return FEntityManager::getInstance()->retriveObject(ERestaurantHall::class, $id);
    }

    public static function getEntityManager()
    {
        // Questo metodo semplicemente inoltra la richiesta a FEntityManager,
        // che è l'unico a dover conoscere l'istanza di Doctrine.
        return FEntityManager::getInstance()->getEntityManager();
    }

    /**
     * Salva un'entità ERestaurantHall nel database.
     * @param \AppORM\Entity\ERestaurantHall $hall
     */
        public static function saveRestaurantHall(string $name, int $totalPlaces)
    {
        $hall = new ERestaurantHall($name, $totalPlaces);
 
        self::uploadObject($hall);

        return true;
       
    }
     public static function deleteRestaurantHall(ERestaurantHall $hall)
    {
        FEntityManager::getInstance()->deleteObject($hall);
    }


     /**
     * Recupera tutti i camerieri associati a una specifica sala ristorante.
     * @param int $hallId L'ID della sala ristorante.
     * @return array Un array di oggetti EWaiter.
     */
    public static function getWaitersByRestaurantHall(int $hallId): array
    {
        // Assumendo che EWaiter abbia una relazione con ERestaurantHall chiamata 'restaurantHall'
        return FEntityManager::getInstance()->retriveObjectList(EWaiter::class, 'restaurantHall', $hallId);
    }

    /**
     * Recupera tutti i tavoli associati a una specifica sala ristorante.
     * @param int $hallId L'ID della sala ristorante.
     * @return array Un array di oggetti ETable.
     */
    public static function getTablesByRestaurantHall(int $hallId): array
    {
        // Assumendo che ETable abbia una relazione con ERestaurantHall chiamata 'restaurantHall'
        return FEntityManager::getInstance()->retriveObjectList(ETable::class, 'restaurantHall', $hallId);
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
        return FEntityManager::getInstance()->selectAll(EClient::class);
    }

    public static function getWaiterByEmail(string $email): ?EWaiter
    {
        return FWaiter::getWaiterByEmail($email);
    }

    public static function registerWaiter(string $name, string $surname, DateTime $birthDate, string $email, string $password,  int $phoneNumber, string $serialNumber, int $hallId): ?EWaiter
    {
        // Ora questa chiamata funziona perché il metodo esiste in questa classe
        if (self::getWaiterByEmail($email)) { return null; }
        
        $hall = self::getRestaurantHallById($hallId);
        if (!$hall) { return null; }

        $waiter = new EWaiter($name, $surname, $birthDate, $email, password_hash($password, PASSWORD_DEFAULT), $phoneNumber, $serialNumber);
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
    
    /**
     * Recupera una singola recensione tramite ID.
     */
    public static function getReviewById(int $id): ?EUserReview
    {
        return FUserReview::getObj($id);
    }


    public static function addAdminResponseToReview(EAdmin $admin, EUserReview $review, string $responseText): bool
    {
        try {
            $response = new EAdminResponse($responseText, new DateTime()); // Crea la nuova risposta
            $response->setAdmin($admin);   
            $response->setUserReview($review);    
            $review->addAdminResponse($response); 
            return FEntityManager::getInstance()->saveObject($response); 
        } catch (Exception $e) {
            error_log("Errore durante il salvataggio della risposta dell'admin: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Recupera una singola risposta dell'admin tramite ID.
     * Necessario per recuperare l'oggetto risposta prima di eliminarlo.
     * @param int $id L'ID della risposta dell'admin.
     * @return EAdminResponse|null L'oggetto risposta o null se non trovato.
     */
    public static function getAdminResponseById(int $id): ?EAdminResponse
    {
        return FEntityManager::getInstance()->retriveObject(EAdminResponse::class, $id);
    }

    /**
     * Elimina una risposta dell'amministratore.
     * @param EAdminResponse $adminResponse L'oggetto risposta da eliminare.
     * @return bool True se l'eliminazione è avvenuta con successo, false altrimenti.
     */
    public static function deleteAdminResponse(EAdminResponse $adminResponse): bool
    {
    
        return FEntityManager::getInstance()->deleteObject($adminResponse); // Usa deleteObject su EAdminResponse
        
    }

    public static function updateAdminResponse(EAdminResponse $adminResponse): bool
    {
        
        return FEntityManager::getInstance()->saveObject($adminResponse);
        
    }


     /**
     * Elimina una recensione di un cliente, verificando che il cliente sia il proprietario della recensione.
     * @param int $reviewId L'ID della recensione da eliminare.
     * @param int $clientId L'ID del cliente che tenta l'eliminazione (per verifica di proprietà).
     * @return bool True se la recensione è stata eliminata con successo, false altrimenti.
     */
    public static function deleteClientReview(int $reviewId, int $clientId): bool
    {
        
        $review = FUserReview::getObj($reviewId); // Recupera la recensione

        if ($review && $review->getClient()->getId() === $clientId) { // Verifica che il cliente sia il proprietario
            return FUserReview::deleteObj($review); // Elimina la recensione
        }
        return false; // Recensione non trovata o cliente non proprietario
       
    }

    /**
     * Recupera un admin tramite il suo indirizzo email.
     * @param string $email
     * @return EAdmin|null
     */
    public static function getAdminByEmail(string $email): ?EAdmin
    {
        return FAdmin::getAdminByEmail($email);
    }

    /**
     * Recupera un cameriere tramite il suo numero di matricola.
     * @param string $serialNumber
     * @return EWaiter|null
     */
    public static function getWaiterBySerialNumber(string $serialNumber): ?EWaiter
    {
        return FEntityManager::getInstance()->retriveObject(EWaiter::class, $serialNumber, 'serialNumber');
    } 
    
    /**
     * Recupera un cliente tramite il suo nickname.
     * @param string $nickname
     * @return EClient|null
     */
    public static function getClientByNickname(string $nickname): ?EClient
    {
        // Si assume che FClient abbia un metodo getClientByNickname,
        // come implicato dalla logica esistente in registerClient.
        return FClient::getClientByNickname($nickname);
    }


}