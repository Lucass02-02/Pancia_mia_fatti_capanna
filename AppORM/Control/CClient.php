<?php // File: AppORM/Control/CClient.php (Completo)

namespace AppORM\Control;

use AppORM\Entity\EClient;
use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\UView;
use AppORM\Services\Utility\USession;
use AppORM\Services\Foundation\FEntityManager;
use AppORM\Entity\ECreditCard;
use AppORM\Entity\EReservation;
use AppORM\Entity\ReservationStatus;
use AppORM\Services\Utility\UCookie;
use DateTime;

class CClient
{
   
   public static function registration(): void
    {
        if (UHTTPMethods::isGet()) {
            UView::render('registration');
        } elseif (UHTTPMethods::isPost()) {
            $name = UHTTPMethods::getPostValue('name');
            $surname = UHTTPMethods::getPostValue('surname');
            $email = UHTTPMethods::getPostValue('email');
            $password = UHTTPMethods::getPostValue('password');
            $birthDateStr = UHTTPMethods::getPostValue('birthDate');
            $nickname = UHTTPMethods::getPostValue('nickname');
            $phoneNumber = UHTTPMethods::getPostValue('phoneNumber');

            
            if (!empty($phoneNumber) && !ctype_digit($phoneNumber)) {
                UView::render('registration', ['success' => false, 'message' => 'Errore: Il numero di telefono può contenere solo cifre numeriche (0-9).']);
                return;
            }

            if (!$name || !$surname || !$email || !$password || !$birthDateStr) {
                UView::render('registration', ['success' => false, 'message' => 'I campi Nome, Cognome, Email, Password e Data di Nascita sono obbligatori.']);
                return;
            }

            $pm = FPersistentManager::getInstance();
            $errorMessage = null;

            if ($pm->getAdminByEmail($email)) {
                $errorMessage = 'Errore: L\'email fornita è già in uso da un amministratore.';
            } elseif ($pm->getWaiterByEmail($email)) {
                $errorMessage = 'Errore: L\'email fornita è già in uso da un cameriere.';
            } elseif ($pm->getClientByEmail($email)) {
                $errorMessage = 'Errore: L\'email fornita è già stata registrata.';
            }

            if (!$errorMessage && !empty($nickname) && $pm->getClientByNickname($nickname)) {
                $errorMessage = 'Errore: Il nickname scelto è già in uso. Prova con un altro.';
            }

            if ($errorMessage) {
                UView::render('registration', ['success' => false, 'message' => $errorMessage]);
                return;
            }

            try {
                $birthDate = new DateTime($birthDateStr);
                $client = $pm->registerClient($name, $surname, $birthDate, $email, $password, $phoneNumber, $nickname);
                
                if ($client) {
                    UView::render('registration', ['success' => true, 'message' => 'Registrazione completata! Ora puoi effettuare il login.']);
                } else {
                    UView::render('registration', ['success' => false, 'message' => 'Si è verificato un errore imprevisto durante la registrazione.']);
                }
            } catch (\Exception $e) {
                UView::render('registration', ['success' => false, 'message' => 'Errore tecnico: ' . $e->getMessage()]);
            }
        }
    }


    public static function login(): void
    {
        if (UHTTPMethods::isGet()) {
            UView::render('login');
        } elseif (UHTTPMethods::isPost()) {
            $email = UHTTPMethods::getPostValue('email');
            $password = UHTTPMethods::getPostValue('password');
            $rememberMe = UHTTPMethods::getPostValue('remember_me'); // Legge il valore della checkbox

            if ($email && $password) {
                // Autenticazione Client
                $client = FPersistentManager::getInstance()->authenticateClient($email, $password);
                if ($client) {
                    USession::setValue('user_id', $client->getId());
                    USession::setValue('user_role', 'client');
                    USession::setValue('user_email', $client->getEmail());
                    
                    if ($rememberMe) {
                        self::setRememberMeCookie('client', $client->getId());
                    }

                    header('Location: /Pancia_mia_fatti_capanna/client/profile');
                    exit;
                }

                // Autenticazione Waiter
                $waiter = FPersistentManager::getInstance()->authenticateWaiter($email, $password);
                if ($waiter) {
                    USession::setValue('user_id', $waiter->getId());
                    USession::setValue('user_role', 'waiter');
                    USession::setValue('user_email', $waiter->getEmail());
                    
                    if ($rememberMe) {
                        self::setRememberMeCookie('waiter', $waiter->getId());
                    }

                    header('Location: /Pancia_mia_fatti_capanna/waiter/profile');
                    exit;
                }

                // Autenticazione Admin
                $admin = FPersistentManager::getInstance()->authenticateAdmin($email, $password);
                if ($admin) {
                    USession::setValue('user_id', $admin->getId());
                    USession::setValue('user_role', 'admin');
                    USession::setValue('user_email', $admin->getEmail());

                    if ($rememberMe) {
                        self::setRememberMeCookie('admin', $admin->getId());
                    }
                    
                    header('Location: /Pancia_mia_fatti_capanna/');
                    exit;
                }

                UView::render('login', ['error' => 'Credenziali non valide. Riprova.']);
            } else {
                UView::render('login', ['error' => 'Email e password sono obbligatori.']);
            }
        }
    }



    /**
     * Mostra la pagina del profilo, ora arricchita con recensioni e carte.
     */
    public static function profile(): void
    {
        if (!USession::isSet('user_id')) {
            header('Location: /Pancia_mia_fatti_capanna/Client/login');
            exit;
        }

        $clientId = USession::getValue('user_id');
        $client = FPersistentManager::getInstance()->getClientById($clientId);

        if ($client) {
            // Passiamo alla vista non solo il cliente, ma anche le sue recensioni e carte
            UView::render('profile', [
                'client' => $client,
                'reviews' => $client->getReviews(),
                'creditCards' => $client->getCreditCards()
            ]);
        } else {
            self::logout();
        }
    }


    public static function logout(): void
    {
        USession::destroy();
        // Al logout, cancella anche il cookie "Ricordami"
        UCookie::delete('remember_user');
        header('Location: /Pancia_mia_fatti_capanna/');
        exit;
    }


    /**
     * Gestisce l'aggiunta di una nuova recensione.
     */
    public static function addReview(): void
    {
        if (!USession::isSet('user_id')) {
            header('Location: /Pancia_mia_fatti_capanna/Client/login');
            exit;
        }

        if (UHTTPMethods::isGet()) {
            UView::render('add_review');
        } elseif (UHTTPMethods::isPost()) {
            $clientId = USession::getValue('user_id');
            $client = FPersistentManager::getClientById($clientId);
            $rating = (int)UHTTPMethods::getPostValue('rating');
            $comment = UHTTPMethods::getPostValue('comment');

            if ($client && $rating >= 1 && $rating <= 5 && !empty($comment)) {
                FPersistentManager::getInstance()->addReviewToClient($client, $comment, $rating);
                header('Location: /Pancia_mia_fatti_capanna/Client/profile');
            } else {
                UView::render('add_review', ['error' => 'Per favore, compila tutti i campi correttamente.']);
            }
        }
    }


    public static function deleteReview(): void
    {
        if (!USession::isSet('user_id')) {
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }

        if (UHTTPMethods::isPost()) {
            $reviewId = (int)UHTTPMethods::getPostValue('review_id');
            $clientId = USession::getValue('user_id');

            if ($reviewId > 0) {
                $deleted = FPersistentManager::getInstance()->deleteClientReview($reviewId, $clientId);
                if ($deleted) {
                    header('Location: /Pancia_mia_fatti_capanna/client/profile');
                    exit;
                }
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/client/profile');
        exit;
    }



    /**
     * Gestisce l'aggiunta di una nuova carta di credito.
     */
    public static function addCreditCard(): void
    {
        if (!USession::isSet('user_id')) {
            header('Location: /Pancia_mia_fatti_capanna/Client/login');
            exit;
        }

        if (UHTTPMethods::isGet()) {
            UView::render('add_credit_card');
        } elseif (UHTTPMethods::isPost()) {
            $clientId = USession::getValue('user_id');
            $client = FPersistentManager::getInstance()->getClientById($clientId);
            
            // In un'app reale, qui ci sarebbe la validazione dei dati della carta
            $brand = UHTTPMethods::getPostValue('brand');
            $last4 = UHTTPMethods::getPostValue('last4');
            $expMonth = (int)UHTTPMethods::getPostValue('expMonth');
            $expYear = (int)UHTTPMethods::getPostValue('expYear');
            $cardName = UHTTPMethods::getPostValue('cardName');

            if ($client && $brand && strlen($last4) === 4 && $expMonth && $expYear) {
                FPersistentManager::getInstance()->addCreditCardToClient($client, $brand, $last4, $expMonth, $expYear, $cardName);
                header('Location: /Pancia_mia_fatti_capanna/Client/profile');
            } else {
                UView::render('add_credit_card', ['error' => 'Per favore, compila tutti i campi correttamente.']);
            }
        }
    }

    /**
     * Gestisce la cancellazione di una carta di credito.
     */
    public static function deleteCreditCard(): void
    {
        if (!USession::isSet('user_id')) {
            header('Location: /Pancia_mia_fatti_capanna/Client/login');
            exit;
        }
        
        // Per sicurezza, controlliamo che la richiesta sia POST
        if (UHTTPMethods::isPost()) {
            $cardId = (int)UHTTPMethods::getPostValue('card_id');
            $clientId = USession::getValue('user_id');
            $card = FEntityManager::getInstance()->retriveObject(ECreditCard::class, $cardId);

            // Ulteriore sicurezza: l'utente può cancellare solo le proprie carte
            if ($card && $card->getClient()->getId() === $clientId) {
                FPersistentManager::getInstance()->deleteCreditCard($cardId);
                header('Location: /Pancia_mia_fatti_capanna/Client/profile');
                exit;
            }
        }
        // Se qualcosa va storto, torna al profilo
        header('Location: /Pancia_mia_fatti_capanna/Client/profile');
    }


    //problema della prenotazione per tavoli diversi nella stessa data e orario, se riesci risolvi senno amen
    
    public static function reserve() {
        if (!USession::isset('user_id')) {
            // Imposto il messaggio solo qui, prima di fare il redirect
            USession::setValue('flash_message', 'Per poter effettuare una prenotazione devi essere registrato');
            Usession::setValue('redirect_page', 'Viene da reserve');
            header('Location: /Pancia_mia_fatti_capanna/Client/login');
            exit;
        }

        if (UHTTPMethods::isGet()) {
            UView::render('reservation');
        } elseif (UHTTPMethods::isPost()) {
            $dateStr = UHTTPMethods::getPostValue('date');
            $date = new DateTime($dateStr);

            $hoursStr = UHTTPMethods::getPostValue('hours');
            $hours = new DateTime($hoursStr);

            $duration = UHTTPMethods::getPostValue('duration');
            $peopleNum = UHTTPMethods::getPostValue('numPeople');
            $note = UHTTPMethods::getPostValue('note');
            $nameReservation = UHTTPMethods::getPostValue('nameReservation');

            if ($date && $hours && $peopleNum && $nameReservation) {
                $clientId = USession::getValue('user_id');
                $client = FPersistentManager::getInstance()->getClientById($clientId);

                $reservation = new EReservation($date, $hours, $duration, $peopleNum, $note, $nameReservation);
                $reservation->setClient($client);

                $result = FPersistentManager::getInstance()->createReservation($reservation);
                if ($result === true) {
                    UView::render('success');
                } else {
                    UView::render('reservation', ['error'=> $result]);
                }
            } else {
                UView::render('reservation', ['error'=> 'Inserisci i dati nei campi obbligatori']);
            }
        }    
    }

    public static function order() {
        

        $clientId = USession::getValue('user_id');
        $client = FEntityManager::getInstance()->retriveObject(EClient::class, $clientId);
        
        $reservations = $client->getReservations();
        

        if ($reservations->isEmpty()) {
            UView::render('client_no_reservation');
            exit;
        }

        $allNotApproved = 'nessuna prenotazione';

        foreach ($reservations as $reservation) {
            if ($reservation->getStatus() === ReservationStatus::APPROVED) {
                $allNotApproved = 'ordine non abilitato';
                break;
            }
            if ( 
                $reservation->getStatus() === ReservationStatus::CANCELED ||
                $reservation->getStatus() === ReservationStatus::CREATED ) {
                break;
            }
            if ($reservation->getStatus() === ReservationStatus::ORDER_IN_PROGRESS) {
                $allNotApproved = 'ordine approvato';
                break;
            }
        }

        if ($allNotApproved === 'nessuna prenotazione') {
            UView::render('client_no_reservation');
            exit;
        }

        if ($allNotApproved === 'ordine non abilitato') {
            UView::render('order_not_approved');
        }

        $selectedAllergensIds = [];

        // Se l'utente invia un nuovo filtro, usalo e salva il cookie
        if (isset($_POST['allergens'])) {
            $selectedAllergensIds = array_map('intval', $_POST['allergens']);
            // Salva gli ID come stringa JSON nel cookie per 1 settimana (604800 secondi)
            UCookie::set('allergen_filter', json_encode($selectedAllergensIds), 604800);
        }
        // Altrimenti, se non c'è un invio POST, prova a leggere dal cookie
        elseif (UCookie::get('allergen_filter')) {
            // Decodifica la stringa JSON salvata nel cookie
            $selectedAllergensIds = json_decode(UCookie::get('allergen_filter'), true);
        }

        $userRole = USession::getValue('user_role');
        $userId = USession::getValue('user_id');

        if ($userRole === 'admin') {
            $allProducts = FPersistentManager::getInstance()->getAllProducts();
        } else {
            $allProducts = FPersistentManager::getInstance()->getAvailableProducts();
        }

        $allAllergens = FPersistentManager::getInstance()->getAllAllergens();

        if (empty($selectedAllergensIds)) {
            $filteredProducts = $allProducts;
        } else {
            $filteredProducts = [];
            foreach ($allProducts as $product) {
                $hasExcludedAllergen = false;
                foreach ($product->getAllergens() as $allergen) {
                    if (in_array($allergen->getId(), $selectedAllergensIds)) {
                        $hasExcludedAllergen = true;
                        break;
                    }
                }
                if (!$hasExcludedAllergen) {
                    $filteredProducts[] = $product;
                }
            }
        }


        if ($allNotApproved === 'ordine approvato') {
            UView::render('menu_ordine',  [
            'products' => $filteredProducts,
            'allAllergens' => $allAllergens,
            'selectedAllergens' => $selectedAllergensIds,
            'user_role' => $userRole,
            'user_id' => $userId,
        ]);
        }
    }

    /**
     * Imposta il cookie per la funzionalità "Ricordami".
     * @param string $role Il ruolo dell'utente (es. 'client', 'admin')
     * @param int $userId L'ID dell'utente
     */
    private static function setRememberMeCookie(string $role, int $userId): void
    {
       
        
        $value = base64_encode(json_encode(['role' => $role, 'id' => $userId]));
        // Imposta il cookie per 30 giorni (2592000 secondi)
        UCookie::set('remember_user', $value, 2592000);
    }



    /**
     * Controlla se esiste un cookie "Ricordami" e, in caso affermativo,
     * effettua il login automatico creando la sessione per l'utente.
     * 
     */
    public static function checkRememberMeLogin(): void
    {
        // 1. Se l'utente è GIÀ loggato nella sessione, non fare nulla.
        if (USession::isSet('user_id')) {
            return;
        }

        // 2. Controlla se il cookie 'remember_user' esiste.
        $rememberCookie = UCookie::get('remember_user');
        if ($rememberCookie) {
            // 3. Decodifica i dati dal cookie.
            $userData = json_decode(base64_decode($rememberCookie), true);

            // 4. Se i dati sono validi (contengono un ID e un ruolo)
            if (isset($userData['id']) && isset($userData['role'])) {
                $userId = (int)$userData['id'];
                $userRole = $userData['role'];
                $user = null;

                // 5. Recupera l'utente dal database in base al suo ruolo.
                // Questo è un controllo di sicurezza per assicurarsi che l'utente esista ancora.
                switch ($userRole) {
                    case 'client':
                        $user = FPersistentManager::getInstance()->getClientById($userId);
                        break;
                    case 'waiter':
                        $user = FPersistentManager::getInstance()->getWaiterById($userId);
                        break;
                    case 'admin':
                        $user = FPersistentManager::getInstance()->getAdminById($userId);
                        break;
                }

                // 6. Se l'utente è stato trovato, crea la sessione per lui.
                if ($user) {
                    USession::setValue('user_id', $user->getId());
                    USession::setValue('user_role', $userRole);
                    USession::setValue('user_email', $user->getEmail());
                } else {
                    // Se l'utente non esiste più nel DB, cancella il cookie non valido.
                    UCookie::delete('remember_user');
                }
            }
        }
    }

    public static function viewReservations(): void
    {
        if (!USession::isSet('user_id')) {
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }

        $clientId = USession::getValue('user_id');
        $client = FEntityManager::getInstance()->retriveObject(EClient::class, $clientId);
        $reservations = $client->getReservations();

        if ($reservations === null || $reservations->isEmpty()) {
            UView::render('client_no_reservation');
        } else {
            UView::render('client_view_reservation', ['reservations' => $reservations]);
        }
    }

}