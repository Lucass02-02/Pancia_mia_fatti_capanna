<?php // File: AppORM/Control/CClient.php

namespace AppORM\Control;

use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Utility\UHTTPMethods;
use AppORM\Services\Utility\UView;
use AppORM\Services\Utility\USession;
use DateTime;

class CClient
{
    // ... il metodo registration() rimane qui ...
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
                    header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=profile');
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
     * Mostra la pagina del profilo dell'utente loggato.
     * Questa è una pagina "protetta".
     */
    public static function profile(): void
    {
        // Controlliamo se l'utente è loggato controllando la sessione.
        if (!USession::isSet('user_id')) {
            // Se non è loggato, lo reindirizziamo alla pagina di login.
            header('Location: /GitHub/Pancia_mia_fatti_capanna/index.php?c=client&a=login');
            exit;
        }

        // Se è loggato, recuperiamo le sue informazioni dal database.
        $clientId = USession::getValue('user_id');
        $client = FPersistentManager::getClientById($clientId);

        if ($client) {
            UView::render('profile', ['client' => $client]);
        } else {
            // Se l'ID in sessione non corrisponde a un utente, distruggiamo la sessione.
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
        header('Location: /GitHub/Pancia_mia_fatti_capanna/');
        exit;
    }
}
