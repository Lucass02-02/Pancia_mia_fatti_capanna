<?php // File: AppORM/Control/CClient.php

namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\UView;
use AppORM\Services\Utility\USession;
use AppORM\Services\Utility\UCookie; // <-- Aggiunto per usare i cookie
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
            $phoneNumber = UHTTPMethods::getPostValue('phoneNumber');
            $nickname = UHTTPMethods::getPostValue('nickname');
            
            if ($name && $surname && $email && $password && $birthDateStr) {
                try {
                    $birthDate = new DateTime($birthDateStr);
                    $client = FPersistentManager::getInstance()->registerClient($name, $surname, $birthDate, $email, $password, $phoneNumber, $nickname);
                    if ($client) {
                        UView::render('registration', ['success' => true, 'message' => 'Registrazione completata! Ora puoi effettuare il login.']);
                    } else {
                        UView::render('registration', ['success' => false, 'message' => 'Errore: Email o Nickname già in uso.']);
                    }
                } catch (\Exception $e) {
                    UView::render('registration', ['success' => false, 'message' => 'Si è verificato un errore tecnico: ' . $e->getMessage()]);
                }
            } else {
                UView::render('registration', ['success' => false, 'message' => 'Tutti i campi obbligatori devono essere compilati.']);
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
     * Controlla se esiste un cookie "Ricordami" e, in caso affermativo,
     * effettua il login automatico creando la sessione per l'utente.
     * QUESTA È LA FUNZIONE CHE CERCAVI.
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

    /**
     * Imposta il cookie per la funzionalità "Ricordami".
     * @param string $role Il ruolo dell'utente (es. 'client', 'admin')
     * @param int $userId L'ID dell'utente
     */
    private static function setRememberMeCookie(string $role, int $userId): void
    {
        // NOTA: Questa è una logica semplificata. Per una sicurezza maggiore,
        // si dovrebbe generare un token casuale, salvarlo nel cookie e salvare
        // il suo HASH nel database associato all'utente.
        
        $value = base64_encode(json_encode(['role' => $role, 'id' => $userId]));
        // Imposta il cookie per 30 giorni (2592000 secondi)
        UCookie::set('remember_user', $value, 2592000);
    }

    public static function profile(): void
    {
        if (!USession::isSet('user_id')) {
            header('Location: /Pancia_mia_fatti_capanna/client/login');
            exit;
        }

        $clientId = USession::getValue('user_id');
        $client = FPersistentManager::getInstance()->getClientById($clientId);

        if ($client) {
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

    public static function addReview(): void
    {
        if (!USession::isSet('user_id')) { header('Location: /Pancia_mia_fatti_capanna/client/login'); exit; }

        if (UHTTPMethods::isGet()) {
            UView::render('add_review');
        } elseif (UHTTPMethods::isPost()) {
            $clientId = USession::getValue('user_id');
            $client = FPersistentManager::getInstance()->getClientById($clientId);
            $rating = (int)UHTTPMethods::getPostValue('rating');
            $comment = UHTTPMethods::getPostValue('comment');

            if ($client && $rating >= 1 && $rating <= 5 && !empty($comment)) {
                FPersistentManager::getInstance()->addReviewToClient($client, $comment, $rating);
                header('Location: /Pancia_mia_fatti_capanna/client/profile/success');
            } else {
                UView::render('add_review', ['error' => 'Per favore, compila tutti i campi correttamente.']);
            }
        }
    }

    public static function addCreditCard(): void
    {
        if (!USession::isSet('user_id')) { header('Location: /Pancia_mia_fatti_capanna/client/login'); exit; }

        if (UHTTPMethods::isGet()) {
            UView::render('add_credit_card');
        } elseif (UHTTPMethods::isPost()) {
            $clientId = USession::getValue('user_id');
            $client = FPersistentManager::getInstance()->getClientById($clientId);
            
            $brand = UHTTPMethods::getPostValue('brand');
            $last4 = UHTTPMethods::getPostValue('last4');
            $expMonth = (int)UHTTPMethods::getPostValue('expMonth');
            $expYear = (int)UHTTPMethods::getPostValue('expYear');
            $cardName = UHTTPMethods::getPostValue('cardName');

            if ($client && $brand && strlen($last4) === 4 && $expMonth && $expYear) {
                FPersistentManager::getInstance()->addCreditCardToClient($client, $brand, $last4, $expMonth, $expYear, $cardName);
                header('Location: /Pancia_mia_fatti_capanna/client/profile/success');
            } else {
                UView::render('add_credit_card', ['error' => 'Per favore, compila tutti i campi correttamente.']);
            }
        }
    }

    public static function deleteCreditCard(): void
    {
        if (!USession::isSet('user_id')) { header('Location: /Pancia_mia_fatti_capanna/client/login'); exit; }
        
        if (UHTTPMethods::isPost()) {
            $cardId = (int)UHTTPMethods::getPostValue('card_id');
            FPersistentManager::getInstance()->deleteCreditCard($cardId);
            header('Location: /Pancia_mia_fatti_capanna/client/profile');
            exit;
        }
        header('Location: /Pancia_mia_fatti_capanna/client/profile');
    }

    private static function checkAdmin(): void {
        if (USession::getValue('user_role') !== 'admin') {
            header('Location: /Pancia_mia_fatti_capanna/');
            exit;
        }
    }

    public static function showCreateForm(): void
    {
        self::checkAdmin();
        $categories = FPersistentManager::getInstance()->getAllProductCategories();
        UView::render('create_product', [
            'categories' => $categories
        ]);
    }

    public static function create(): void
    {
        self::checkAdmin();
        if (UHTTPMethods::isPost()) {
            $name = UHTTPMethods::getPostValue('name');
            $description = UHTTPMethods::getPostValue('description');
            $price = (float)UHTTPMethods::getPostValue('price');
            $categoryId = (int)UHTTPMethods::getPostValue('category_id');

            if ($name && $description && $price > 0 && $categoryId > 0) {
                $category = FPersistentManager::getInstance()->getProductCategoryById($categoryId);
                if ($category) {
                    $product = new \AppORM\Entity\EProduct($name, $description, $price, $category);
                    FPersistentManager::getInstance()->saveProduct($product);
                }
            }
        }
        header('Location: /Pancia_mia_fatti_capanna/home/menu');
        exit;
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
}
