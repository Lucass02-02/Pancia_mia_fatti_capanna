<?php // File: AppORM/Control/CClient.php (Completo)

namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\UView;
use AppORM\Services\Utility\USession;
use AppORM\Services\Foundation\FEntityManager;
use AppORM\Entity\ECreditCard;
use AppORM\Services\Utility\UCookie;
use DateTime;

class CClient
{
    public static function isLogged(): bool {
    if (session_status() == PHP_SESSION_NONE) {
        USession::start();
    }
    return USession::getValue('user') !== null;
}



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
            
            if ($name && $surname && $email && $password && $birthDateStr && $nickname && $phoneNumber) {
                try {
                    $birthDate = new DateTime($birthDateStr);
                    $client = FPersistentManager::getInstance()->registerClient($name, $surname, $birthDate, $email, $password, $nickname, $phoneNumber);
                    if ($client) {
                        UView::render('registration', ['success' => true, 'message' => 'Registrazione completata! Ora puoi effettuare il login.']);
                    } else {
                        UView::render('registration', ['success' => false, 'message' => 'Errore: Email già in uso. Prova con un\'altra email.']);
                    }
                } catch (\Exception $e) {
                    UView::render('registration', ['success' => false, 'message' => 'Si è verificato un errore tecnico. Dettagli: ' . $e->getMessage()]);
                }
            } else {
                UView::render('registration', ['success' => false, 'message' => 'Tutti i campi sono obbligatori.']);
            }
        }
    }
    /**
     * Gestisce il login di un cliente.
     * GET: mostra il form di login.
     * POST: autentica l'utente e crea la sessione.
     */
 public static function login(): void
{
    $message = USession::getValue('flash_message');
        if ($message) {
            USession::setValue('flash_message', null);
        }

    if (UHTTPMethods::isGet()) {
        UView::render('login', ['error' => $message]);
    } elseif (UHTTPMethods::isPost()) {
        $email = UHTTPMethods::getPostValue('email');
        $password = UHTTPMethods::getPostValue('password');

        if ($email && $password) {
            $client = FPersistentManager::getInstance()->authenticateClient($email, $password);
            if ($client) {
                USession::setValue('user_id', $client->getId());
                USession::setValue('user_role', 'client');
                USession::setValue('user_email', $client->getEmail());
                header('Location: /Pancia_mia_fatti_capanna/client/profile');
                exit;
            }

            $waiter = FPersistentManager::getInstance()->authenticateWaiter($email, $password);
            if ($waiter) {
                USession::setValue('user_id', $waiter->getId());
                USession::setValue('user_role', 'waiter');
                USession::setValue('user_email', $waiter->getEmail());
                header('Location: /Pancia_mia_fatti_capanna/waiter/profile');
                exit;
            }

            $admin = FPersistentManager::getInstance()->authenticateAdmin($email, $password);
            if ($admin) {
                USession::setValue('user_id', $admin->getId());
                USession::setValue('user_role', 'admin');
                USession::setValue('user_email', $admin->getEmail());
                header('Location: /Pancia_mia_fatti_capanna/');
                exit;
            }

            UView::render('login', ['error' => 'Credenziali non valide. Riprova']);
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
    
     /**
     * Esegue il logout distruggendo la sessione.
     */
    public static function logout(): void
    {
        USession::destroy();
        // Reindirizziamo l'utente alla homepage.
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
                header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=profile&review=success');
            } else {
                UView::render('add_review', ['error' => 'Per favore, compila tutti i campi correttamente.']);
            }
        }
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
                header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=profile&card=success');
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
                header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=profile&card=deleted');
                exit;
            }
        }
        // Se qualcosa va storto, torna al profilo
        header('Location: /Pancia_mia_fatti_capanna/Client/profile');
    }


    public static function reserve() {
    if (!CClient::isLogged()) {
        // Imposto il messaggio solo qui, prima di fare il redirect
        if (session_status() == PHP_SESSION_NONE) {
            USession::start();
        }
        USession::setValue('flash_message', 'Per poter effettuare una prenotazione devi essere registrato');
        header('Location: /Pancia_mia_fatti_capanna/Client/login');
        exit;
    }

    // Se loggato, mostra la pagina di prenotazione normalmente
    UView::render('reservation', ['logged' => true]);
}

}
