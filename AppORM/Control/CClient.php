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

            UView::render('login', ['error' => 'Credenziali non valide. Riprova.']);
        } else {
            UView::render('login', ['error' => 'Email e password sono obbligatori.']);
        }
    }
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

    // Modificato per accettare l'ID della carta come segmento dell'URL se si desidera usarlo così
    // e per reindirizzare a un URL pulito.
    public static function deleteCreditCard(): void // La form POST invia l'ID con metodo POST
    {
        if (!USession::isSet('user_id')) { header('Location: /Pancia_mia_fatti_capanna/client/login'); exit; }
        
        if (UHTTPMethods::isPost()) {
            $cardId = (int)UHTTPMethods::getPostValue('card_id');
            FPersistentManager::getInstance()->deleteCreditCard($cardId);
            // URL pulito
            header('Location: /Pancia_mia_fatti_capanna/client/profile?card=deleted');
            exit;
        }
        header('Location: /Pancia_mia_fatti_capanna/client/profile');
    }

    // Questi metodi sembrano appartenere a CProduct, li lascio ma sono un duplicato.
    private static function checkAdmin(): void { // Aggiunto per evitare errore se chiamati
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
}