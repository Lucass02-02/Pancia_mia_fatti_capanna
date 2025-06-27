<?php
// PHP Version: 8.1+

namespace App\Foundation;

// Importa le classi Foundation che FPersistentManager coordinerà
use App\Foundation\FClient;
use App\Foundation\FUserReview;
use App\Foundation\FCreditCard; // Importa FCreditCard
use App\Foundation\FEntityManager; // Ensure FEntityManager is imported for direct saving/deleting

// Importa le entità specifiche che i metodi potrebbero ricevere o restituire
use AppORM\Entity\EClient;
use AppORM\Entity\EUserReview;
use AppORM\Entity\ECreditCard; // Importa ECreditCard

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class FPersistentManager
 * Questa classe funge da facade o gestore di alto livello per le operazioni di persistenza.
 * I suoi metodi delegano il lavoro effettivo alle classi Foundation (FClient, FUserReview, ecc.).
 * Può anche incapsulare logica di business a livello di processo che coinvolge più entità.
 */
class FPersistentManager
{
    public static function saveClient(EClient $client): bool
    {
        return FClient::saveObj($client);
    }

    public static function getClientById(int $clientId): ?EClient
    {
        return FClient::getObj($clientId);
    }

    public static function getClientByEmail(string $email): ?EClient
    {
        return FClient::getObjByEmail($email);
    }

    public static function checkClientEmailExists(string $email): bool
    {
        return FClient::checkEmailExists($email);
    }

    public static function updateClientPhonenumber(EClient $client, ?string $phonenumber): void
    {
        FClient::setPhonenumber($client, $phonenumber);
    }

    public static function updateClientEmail(EClient $client, string $email): void
    {
        FClient::setEmail($client, $email);
    }

    public static function saveUserReview(EUserReview $review): bool
    {
        return FUserReview::saveObj($review);
    }

    public static function getReviewsForClient(EClient $client): array
    {
        return FUserReview::getReviewsByClient($client);
    }

    public static function deleteClient(EClient $client): bool
    {
        return FClient::deleteObj($client);
    }

    // --- NUOVI METODI UTILI BASATI SULLA DESCRIZIONE DEL PROGETTO ---

    /**
     * Registra un nuovo cliente nel sistema.
     * Il parametro `savedMethods` è stato rimosso in quanto le carte di credito sono gestite separatamente.
     * @param string $name
     * @param string $surname
     * @param DateTime $birthDate
     * @param string $email
     * @param string $password La password in chiaro, verrà hashata internamente.
     * @param string|null $nickname
     * @param string|null $phonenumber
     * @return EClient|null Il cliente appena registrato o null in caso di fallimento.
     */
    public static function registerClient(
        string $name,
        string $surname,
        DateTime $birthDate,
        string $email,
        string $password,
        ?string $nickname = null,
        ?string $phonenumber = null
    ): ?EClient {
        try {
            if (self::checkClientEmailExists($email)) {
                echo "DEBUG REGISTRATION: Email '" . $email . "' esiste già nel database, registrazione bloccata.\n"; // AGGIUNTO DEBUG
                error_log("Tentativo di registrazione con email duplicata: " . $email);
                return null;
            }

            $client = new EClient(
                $name,
                $surname,
                $birthDate,
                $email,
                password_hash($password, PASSWORD_BCRYPT),
                $nickname,
                $phonenumber
            );

            if (FClient::saveObj($client)) {
                return $client;
            }
            return null;
        } catch (\Exception $e) {
            echo "DEBUG REGISTRATION: Errore durante la registrazione: " . $e->getMessage() . "\n"; // AGGIUNTO DEBUG
            error_log("Errore durante la registrazione del cliente: " . $e->getMessage());
            return null;
        }
    }

    public static function authenticateClient(string $email, string $password): ?EClient
    {
        $client = self::getClientByEmail($email);
        if ($client) {
            $storedHash = $client->getPassword();
            // --- INIZIO DEBUG PASSWORD ---
            error_log("DEBUG AUTH: Tentativo di autenticazione per email: {$email}");
            error_log("DEBUG AUTH: Password fornita (non hashata): '{$password}'");
            error_log("DEBUG AUTH: Password hashata nel DB: '{$storedHash}'");
            // --- FINE DEBUG PASSWORD ---

            $isVerified = password_verify($password, $storedHash);

            // --- INIZIO DEBUG PASSWORD ---
            error_log("DEBUG AUTH: Risultato di password_verify(): " . ($isVerified ? 'TRUE' : 'FALSE'));
            // --- FINE DEBUG PASSWORD ---

            if ($isVerified) {
                return $client;
            }
        }
        return null;
    }

    /**
     * Aggiorna il profilo di un cliente con i dati forniti.
     * La gestione dei metodi di pagamento salvati è ora tramite metodi dedicati (es. addClientCreditCard).
     * @param EClient $client L'oggetto EClient da aggiornare.
     * @param array $data Un array associativo con i campi da aggiornare.
     * @return bool True se l'aggiornamento ha successo, false altrimenti.
     */
    public static function updateClientProfile(EClient $client, array $data): bool
    {
        try {
            if (isset($data['name'])) {
                FClient::setName($client, $data['name']);
            }
            if (isset($data['surname'])) {
                FClient::setSurname($client, $data['surname']);
            }
            if (isset($data['email'])) {
                $existingClient = self::getClientByEmail($data['email']);
                if ($existingClient && $existingClient->getId() !== $client->getId()) {
                    error_log("Aggiornamento fallito: email '" . $data['email'] . "' già in uso da un altro utente.");
                    return false;
                }
                FClient::setEmail($client, $data['email']);
            }
            if (isset($data['password'])) {
                $newHashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
                FClient::setPassword($client, $newHashedPassword);
            }
            if (isset($data['phonenumber'])) {
                FClient::setPhonenumber($client, $data['phonenumber']);
            }
            if (isset($data['nickname'])) {
                FClient::setNickname($client, $data['nickname']);
            }
            if (isset($data['receivesNotifications'])) {
                FClient::setReceivesNotifications($client, (bool)$data['receivesNotifications']);
            }
            if (isset($data['loyaltyPoints'])) {
                FClient::setLoyaltyPoints($client, (int)$data['loyaltyPoints']);
            }
            return true;
        } catch (\Exception $e) {
            error_log("Errore in FPersistentManager::updateClientProfile: " . $e->getMessage());
            return false;
        }
    }

    public static function getAllRegisteredClients(): array
    {
        return FClient::getAllClients();
    }

    public static function submitClientReview(EClient $client, string $description, int $vote): ?EUserReview
    {
        try {
            $review = new EUserReview($client, $description, $vote, new DateTime(), new DateTime());
            if (FUserReview::saveObj($review)) {
                return $review;
            }
            return null;
        } catch (\Exception $e) {
            error_log("Errore durante l'invio della recensione: " . $e->getMessage());
            return null;
        }
    }

    public static function getAverageUserRating(?EClient $client = null): float
    {
        return FUserReview::getAverageRating($client);
    }

    public static function getRecentUserReviews(int $limit = 10): array
    {
        return FUserReview::getLatestReviews($limit);
    }

    // --- METODI SPOSTATI DA FClient PER GESTIRE ECreditCard TRAMITE FPersistentManager ---

    /**
     * Aggiunge una carta di credito a un cliente.
     * Crea un'istanza di ECreditCard e la associa al cliente, poi salva la carta.
     * @param EClient $client Il cliente a cui aggiungere la carta.
     * @param string $nominative Il nominativo sulla carta.
     * @param string $number Il numero della carta.
     * @param string $CVV Il CVV della carta.
     * @param DateTime $expirationDate La data di scadenza della carta.
     * @param string $name Un nome descrittivo per la carta (es. "Mia Visa").
     * @return ECreditCard|null La carta di credito appena creata, o null in caso di errore.
     */
    public static function addClientCreditCard(
        EClient $client,
        string $nominative,
        string $number,
        string $CVV,
        DateTime $expirationDate,
        string $name
    ): ?ECreditCard {
        try {
            $creditCard = new ECreditCard($client, $nominative, $number, $CVV, $expirationDate, $name);
            // Non è necessario addCreditCard a EClient qui perché il costruttore di ECreditCard imposta il client
            // E la persistenza della carta dovrebbe essere gestita da FCreditCard
            if (FCreditCard::saveObj($creditCard)) { // Salva la carta di credito direttamente
                return $creditCard;
            }
            return null;
        } catch (\Exception $e) {
            error_log("Errore durante l'aggiunta della carta di credito al cliente: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Rimuove una carta di credito da un cliente.
     * Delega la rimozione effettiva a FCreditCard::deleteObj.
     * @param EClient $client Il cliente da cui rimuovere la carta (usato solo per validazione se necessario).
     * @param ECreditCard $creditCard La carta da rimuovere.
     * @return bool True se la rimozione ha successo, false altrimenti.
     */
    public static function removeClientCreditCard(EClient $client, ECreditCard $creditCard): bool
    {
        try {
            // Opzionalmente, potresti voler verificare che la carta appartenga a questo client prima di eliminare
            // if ($creditCard->getClient()->getId() !== $client->getId()) {
            //     error_log("Tentativo di rimuovere una carta non associata al cliente fornito.");
            //     return false;
            // }

            return FCreditCard::deleteObj($creditCard); // Delega la cancellazione a FCreditCard
        } catch (\Exception $e) {
            error_log("Errore durante la rimozione della carta di credito dal cliente: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Recupera tutte le carte di credito salvate per un dato cliente.
     * Delega a FCreditCard::getCreditCardListByClient.
     * @param EClient $client Il cliente.
     * @return ECreditCard[] Una lista di oggetti ECreditCard.
     */
    public static function getClientCreditCards(EClient $client): array
    {
        return FCreditCard::getCreditCardListByClient($client);
    }
}