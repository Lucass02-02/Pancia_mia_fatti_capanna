<?php // File: AppORM/Control/CClient.php (Completo)

namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\UView;
use AppORM\Services\Utility\USession;
use AppORM\Services\Foundation\FEntityManager;
use AppORM\Entity\ECreditCard;
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
            
            if ($name && $surname && $email && $password && $birthDateStr) {
                try {
                    $birthDate = new DateTime($birthDateStr);
                    $client = FPersistentManager::registerClient($name, $surname, $birthDate, $email, $password);
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
        if (UHTTPMethods::isGet()) {
            UView::render('login');
        } elseif (UHTTPMethods::isPost()) {
            $email = UHTTPMethods::getPostValue('email');
            $password = UHTTPMethods::getPostValue('password');

            if ($email && $password) {
                // Usiamo il metodo già pronto del PersistentManager
                $client = FPersistentManager::authenticateClient($email, $password);

                if ($client) {
                    // Login riuscito! Salviamo l'ID del cliente in sessione.
                    USession::setValue('user_id', $client->getId());
                    // Reindirizziamo l'utente alla sua pagina del profilo.
                    header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=profile');
                    exit;
                } else {
                    // Login fallito
                    UView::render('login', ['error' => 'Credenziali non valide. Riprova.']);
                }
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
            header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=login');
            exit;
        }

        $clientId = USession::getValue('user_id');
        $client = FPersistentManager::getClientById($clientId);

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
            header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=login');
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
                FPersistentManager::addReviewToClient($client, $comment, $rating);
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
            header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=login');
            exit;
        }

        if (UHTTPMethods::isGet()) {
            UView::render('add_credit_card');
        } elseif (UHTTPMethods::isPost()) {
            $clientId = USession::getValue('user_id');
            $client = FPersistentManager::getClientById($clientId);
            
            // In un'app reale, qui ci sarebbe la validazione dei dati della carta
            $brand = UHTTPMethods::getPostValue('brand');
            $last4 = UHTTPMethods::getPostValue('last4');
            $expMonth = (int)UHTTPMethods::getPostValue('expMonth');
            $expYear = (int)UHTTPMethods::getPostValue('expYear');
            $cardName = UHTTPMethods::getPostValue('cardName');

            if ($client && $brand && strlen($last4) === 4 && $expMonth && $expYear) {
                FPersistentManager::addCreditCardToClient($client, $brand, $last4, $expMonth, $expYear, $cardName);
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
            header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=login');
            exit;
        }
        
        // Per sicurezza, controlliamo che la richiesta sia POST
        if (UHTTPMethods::isPost()) {
            $cardId = (int)UHTTPMethods::getPostValue('card_id');
            $clientId = USession::getValue('user_id');
            $card = FEntityManager::retriveObject(ECreditCard::class, $cardId);

            // Ulteriore sicurezza: l'utente può cancellare solo le proprie carte
            if ($card && $card->getClient()->getId() === $clientId) {
                FPersistentManager::deleteCreditCard($cardId);
                header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=profile&card=deleted');
                exit;
            }
        }
        // Se qualcosa va storto, torna al profilo
        header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=profile');
    }
}
