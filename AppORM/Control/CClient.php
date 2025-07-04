<?php // File: AppORM/Control/CClient.php

namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\UView;
use AppORM\Services\Utility\USession;
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
<<<<<<< Updated upstream
                    $client = FPersistentManager::registerClient($name, $surname, $birthDate, $email, $password);
=======
                    // Uso il FPersistentManager come richiesto
                    $client = FPersistentManager::getInstance()->registerClient($name, $surname, $birthDate, $email, $password, $phoneNumber, $nickname);
>>>>>>> Stashed changes
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

            if ($email && $password) {
<<<<<<< Updated upstream
                // Usiamo il metodo già pronto del PersistentManager
                $client = FPersistentManager::authenticateClient($email, $password);

=======
                // Uso il FPersistentManager come richiesto
                $client = FPersistentManager::getInstance()->authenticateClient($email, $password);
>>>>>>> Stashed changes
                if ($client) {
                    USession::setValue('user_id', $client->getId());
<<<<<<< Updated upstream
                    // Reindirizziamo l'utente alla sua pagina del profilo.
                    header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=profile');
=======
                    header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=profile');
>>>>>>> Stashed changes
                    exit;
                } else {
                    UView::render('login', ['error' => 'Credenziali non valide. Riprova.']);
                }
            } else {
                UView::render('login', ['error' => 'Email e password sono obbligatori.']);
            }
        }
    }

    public static function profile(): void
    {
        if (!USession::isSet('user_id')) {
            header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=login');
            exit;
        }

        $clientId = USession::getValue('user_id');
<<<<<<< Updated upstream
        $client = FPersistentManager::getClientById($clientId);
=======
        // Uso il FPersistentManager come richiesto
        $client = FPersistentManager::getInstance()->getClientById($clientId);
>>>>>>> Stashed changes

        if ($client) {
            // Qui il controller passa correttamente l'oggetto Client alla vista.
            // L'errore si verifica dopo, quando la vista prova a usare le relazioni.
            UView::render('profile', [
                'client' => $client,
                'reviews' => $client->getReviews(), // La chiamata che scatena l'errore di mapping
                'creditCards' => $client->getCreditCards() // Anche questa
            ]);
        } else {
            self::logout();
        }
    }
    
    public static function logout(): void
    {
        USession::destroy();
<<<<<<< Updated upstream
        // Reindirizziamo l'utente alla homepage.
        header('Location: /GitHub/Pancia_mia_fatti_capanna/');
=======
        header('Location: /Pancia_mia_fatti_capanna/');
>>>>>>> Stashed changes
        exit;
    }

    public static function addReview(): void
    {
<<<<<<< Updated upstream
        if (!USession::isSet('user_id')) {
            header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=login');
            exit;
        }
=======
        if (!USession::isSet('user_id')) { header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=login'); exit; }
>>>>>>> Stashed changes

        if (UHTTPMethods::isGet()) {
            UView::render('add_review');
        } elseif (UHTTPMethods::isPost()) {
            $clientId = USession::getValue('user_id');
            $client = FPersistentManager::getInstance()->getClientById($clientId);
            $rating = (int)UHTTPMethods::getPostValue('rating');
            $comment = UHTTPMethods::getPostValue('comment');

            if ($client && $rating >= 1 && $rating <= 5 && !empty($comment)) {
<<<<<<< Updated upstream
                FPersistentManager::addReviewToClient($client, $comment, $rating);
                header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=profile&review=success');
=======
                // Uso il FPersistentManager come richiesto
                FPersistentManager::getInstance()->addReviewToClient($client, $comment, $rating);
                header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=profile&review=success');
>>>>>>> Stashed changes
            } else {
                UView::render('add_review', ['error' => 'Per favore, compila tutti i campi correttamente.']);
            }
        }
    }

    public static function addCreditCard(): void
    {
<<<<<<< Updated upstream
        if (!USession::isSet('user_id')) {
            header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=login');
            exit;
        }
=======
        if (!USession::isSet('user_id')) { header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=login'); exit; }
>>>>>>> Stashed changes

        if (UHTTPMethods::isGet()) {
            UView::render('add_credit_card');
        } elseif (UHTTPMethods::isPost()) {
            $clientId = USession::getValue('user_id');
            $client = FPersistentManager::getClientById($clientId);
            
            $brand = UHTTPMethods::getPostValue('brand');
            $last4 = UHTTPMethods::getPostValue('last4');
            $expMonth = (int)UHTTPMethods::getPostValue('expMonth');
            $expYear = (int)UHTTPMethods::getPostValue('expYear');
            $cardName = UHTTPMethods::getPostValue('cardName');

            if ($client && $brand && strlen($last4) === 4 && $expMonth && $expYear) {
<<<<<<< Updated upstream
                FPersistentManager::addCreditCardToClient($client, $brand, $last4, $expMonth, $expYear, $cardName);
                header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=profile&card=success');
=======
                 // Uso il FPersistentManager come richiesto
                FPersistentManager::getInstance()->addCreditCardToClient($client, $brand, $last4, $expMonth, $expYear, $cardName);
                header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=profile&card=success');
>>>>>>> Stashed changes
            } else {
                UView::render('add_credit_card', ['error' => 'Per favore, compila tutti i campi correttamente.']);
            }
        }
    }

    public static function deleteCreditCard(): void
    {
<<<<<<< Updated upstream
        if (!USession::isSet('user_id')) {
            header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=login');
            exit;
        }
=======
        if (!USession::isSet('user_id')) { header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=login'); exit; }
>>>>>>> Stashed changes
        
        if (UHTTPMethods::isPost()) {
            $cardId = (int)UHTTPMethods::getPostValue('card_id');
<<<<<<< Updated upstream
            $clientId = USession::getValue('user_id');
            $card = FEntityManager::retriveObject(ECreditCard::class, $cardId);

            // Ulteriore sicurezza: l'utente può cancellare solo le proprie carte
            if ($card && $card->getClient()->getId() === $clientId) {
                FPersistentManager::deleteCreditCard($cardId);
                header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=profile&card=deleted');
                exit;
            }
        }
        // Se qualcosa va storto, torna al profilo
        header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=profile');
=======
             // Uso il FPersistentManager come richiesto
            FPersistentManager::getInstance()->deleteCreditCard($cardId);
            header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=profile&card=deleted');
            exit;
        }
        header('Location: /Pancia_mia_fatti_capanna/index.php?c=client&a=profile');
>>>>>>> Stashed changes
    }
}