<?php
// PHP Version: 8.1+

namespace App\Foundation;

use AppORM\Entity\EClient;
use AppORM\Entity\ECreditCard;
use AppORM\Entity\EUserReview;
use AppORM\Entity\EProduct;
use AppORM\Entity\EAllergens;
use App\Foundation\FEntityManager;
use App\Foundation\FClient;
use App\Foundation\FCreditCard;
use App\Foundation\FAllergens;
use App\Foundation\FProduct;
use DateTime;
use Exception;

/**
 * Classe FPersistentManager.
 * Questa classe funge da facciata per tutte le operazioni di persistenza
 * del dominio, astrando l'applicazione dai dettagli specifici di Doctrine ORM.
 * Fornisce un'interfaccia semplice e coerente per la gestione di entità chiave.
 */
class FPersistentManager
{
    /**
     * Registra un nuovo cliente nel sistema.
     *
     * @param string $name Il nome del cliente.
     * @param string $surname Il cognome del cliente.
     * @param DateTime $birthDate La data di nascita del cliente.
     * @param string $email L'indirizzo email del cliente (deve essere unico).
     * @param string $password La password in chiaro del cliente.
     * @param string|null $nickname Il nickname del cliente (opzionale, deve essere unico se fornito).
     * @param string|null $phoneNumber Il numero di telefono del cliente (opzionale).
     * @return EClient|null L'oggetto EClient registrato o null in caso di fallimento (es. email/nickname già esistenti).
     */
    public static function registerClient(
        string $name,
        string $surname,
        DateTime $birthDate,
        string $email,
        string $password,
        ?string $nickname = null,
        ?string $phoneNumber = null
    ): ?EClient {
        // Verifica se l'email o il nickname sono già in uso
        if (FClient::getClientByEmail($email) !== null) {
            error_log("Tentativo di registrazione con email già esistente: " . $email);
            return null; // Email già in uso
        }
        if ($nickname !== null && FClient::getClientByNickname($nickname) !== null) {
            error_log("Tentativo di registrazione con nickname già esistente: " . $nickname);
            return null; // Nickname già in uso
        }

        $client = new EClient($name, $surname, $birthDate, $email, password_hash($password, PASSWORD_DEFAULT));
        $client->setNickname($nickname);
        $client->setPhonenumber($phoneNumber);
        $client->setReceivesNotifications(false); // Default
        $client->setLoyaltyPoints(0);             // Default

        if (FClient::saveObj($client)) {
            return $client;
        }
        return null;
    }

    /**
     * Autentica un cliente tramite email e password.
     *
     * @param string $email L'email del cliente.
     * @param string $password La password in chiaro fornita dall'utente.
     * @return EClient|null L'oggetto EClient autenticato o null in caso di credenziali non valide.
     */
    public static function authenticateClient(string $email, string $password): ?EClient
    {
        $client = FClient::getClientByEmail($email);
        if ($client && password_verify($password, $client->getPassword())) {
            return $client;
        }
        return null;
    }

    /**
     * Recupera un cliente tramite il suo ID.
     * @param int $id L'ID del cliente.
     * @return EClient|null Il cliente trovato o null.
     */
    public static function getClientById(int $id): ?EClient
    {
        return FClient::getObj($id);
    }

    /**
     * Recupera un cliente tramite la sua email.
     * @param string $email L'email del cliente.
     * @return EClient|null Il cliente trovato o null.
     */
    public static function getClientByEmail(string $email): ?EClient
    {
        return FClient::getClientByEmail($email);
    }

    /**
     * Aggiorna il numero di telefono di un cliente.
     * @param EClient $client L'oggetto cliente da aggiornare.
     * @param string|null $newPhoneNumber Il nuovo numero di telefono.
     * @return bool True se l'aggiornamento ha successo, false altrimenti.
     */
    public static function updateClientPhonenumber(EClient $client, ?string $newPhoneNumber): bool
    {
        return FClient::setPhonenumber($client, $newPhoneNumber);
    }

    /**
     * Aggiorna il nickname di un cliente.
     * @param EClient $client L'oggetto cliente da aggiornare.
     * @param string|null $newNickname Il nuovo nickname.
     * @return bool True se l'aggiornamento ha successo, false altrimenti.
     */
    public static function updateClientNickname(EClient $client, ?string $newNickname): bool
    {
        return FClient::setNickname($client, $newNickname);
    }

    /**
     * Aggiorna lo stato di ricezione notifiche di un cliente.
     * @param EClient $client L'oggetto cliente da aggiornare.
     * @param bool $status Lo stato di ricezione notifiche.
     * @return bool True se l'aggiornamento ha successo, false altrimenti.
     */
    public static function updateClientReceivesNotifications(EClient $client, bool $status): bool
    {
        return FClient::setReceivesNotifications($client, $status);
    }

    /**
     * Aggiunge punti fedeltà a un cliente.
     * @param EClient $client L'oggetto cliente.
     * @param int $pointsToAdd I punti da aggiungere.
     * @return bool True se l'aggiornamento ha successo.
     */
    public static function addClientLoyaltyPoints(EClient $client, int $pointsToAdd): bool
    {
        $newPoints = $client->getLoyaltyPoints() + $pointsToAdd;
        return FClient::setLoyaltyPoints($client, $newPoints);
    }

    /**
     * Rimuove punti fedeltà a un cliente. Non scende sotto zero.
     * @param EClient $client L'oggetto cliente.
     * @param int $pointsToRemove I punti da rimuovere.
     * @return bool True se l'aggiornamento ha successo.
     */
    public static function removeClientLoyaltyPoints(EClient $client, int $pointsToRemove): bool
    {
        $newPoints = max(0, $client->getLoyaltyPoints() - $pointsToRemove);
        return FClient::setLoyaltyPoints($client, $newPoints);
    }

    /**
     * Aggiunge una recensione a un cliente.
     * @param EUserReview $review L'oggetto recensione da salvare.
     * @return bool True in caso di successo.
     */
    public static function addClientReview(EUserReview $review): bool
    {
        return FEntityManager::saveObject($review); // Modificato per usare il metodo statico di FEntityManager
    }


    /**
     * Aggiunge una carta di credito a un cliente.
     * @param EClient $client Il cliente a cui aggiungere la carta.
     * @param string $cardHolderName Nome del titolare.
     * @param string $cardNumber Numero della carta.
     * @param string $cvv CVV della carta.
     * @param DateTime $expirationDate Data di scadenza.
     * @param string|null $cardName Nome amichevole della carta (es. "La mia Visa").
     * @return ECreditCard|null La carta di credito salvata o null in caso di fallimento.
     */
    public static function addClientCreditCard(
        EClient $client,
        string $cardHolderName,
        string $cardNumber,
        string $cvv,
        DateTime $expirationDate,
        ?string $cardName = null
    ): ?ECreditCard {
        // Linea corretta: passa $cardName al costruttore di ECreditCard
        $creditCard = new ECreditCard($client, $cardHolderName, $cardNumber, $cvv, $expirationDate, $cardName);

        if (FCreditCard::saveObj($creditCard)) {
            return $creditCard;
        }
        return null;
    }

    /**
     * Recupera tutte le carte di credito associate a un cliente.
     * @param EClient $client L'oggetto cliente.
     * @return array Un array di oggetti ECreditCard.
     */
    public static function getClientCreditCards(EClient $client): array
    {
        // Doctrine dovrebbe caricare automaticamente la collezione se la relazione è configurata
        return $client->getCreditCards()->toArray();
    }

    /**
     * Rimuove una carta di credito da un cliente.
     *
     * @param EClient $client Il cliente da cui rimuovere la carta.
     * @param ECreditCard $creditCard La carta di credito da rimuovere (deve essere un'entità gestita).
     * @return bool True se la rimozione ha successo, false altrimenti.
     */
    public static function removeClientCreditCard(EClient $client, ECreditCard $creditCard): bool
    {
        // Rimuove la carta dalla collezione del client (se bidirezionale)
        if ($client->getCreditCards()->contains($creditCard)) {
            $client->removeCreditCard($creditCard);
            FClient::saveObj($client); // Salva la modifica alla relazione nel client
        }
        // Elimina l'entità CreditCard dal database
        return FCreditCard::deleteObj($creditCard);
    }

    /**
     * Elimina un cliente e le sue dipendenze (recensioni, carte di credito, ordini, prenotazioni)
     * se configurate con cascade.
     * @param EClient $client L'oggetto cliente da eliminare.
     * @return bool True se l'eliminazione ha successo.
     */
    public static function deleteClient(EClient $client): bool
    {
        return FClient::deleteObj($client);
    }

    /**
     * Salva un oggetto EProduct nel database.
     * @param EProduct $product L'entità EProduct da salvare.
     * @return bool True in caso di successo.
     */
    public static function saveProduct(EProduct $product): bool
    {
        return FProduct::saveObj($product);
    }

    /**
     * Recupera un prodotto tramite il suo ID.
     * @param int $id L'ID del prodotto.
     * @return EProduct|null Il prodotto trovato o null.
     */
    public static function getProductById(int $id): ?EProduct
    {
        return FProduct::getObj($id);
    }

    /**
     * Aggiorna la disponibilità di un prodotto.
     * @param EProduct $product L'oggetto prodotto.
     * @param bool $availability La nuova disponibilità.
     * @return bool True se l'aggiornamento ha successo.
     */
    public static function updateProductAvailability(EProduct $product, bool $availability): bool
    {
        return FProduct::setAvailability($product, $availability);
    }

    /**
     * Elimina un prodotto dal database.
     * @param EProduct $product L'entità EProduct da eliminare.
     * @return bool True in caso di successo.
     */
    public static function deleteProduct(EProduct $product): bool
    {
        return FProduct::deleteObj($product);
    }

    /**
     * Salva un oggetto EAllergens nel database.
     * @param EAllergens $allergen L'entità EAllergens da salvare.
     * @return bool True in caso di successo.
     */
    public static function saveAllergen(EAllergens $allergen): bool
    {
        return FAllergens::saveObj($allergen);
    }

    /**
     * Recupera un allergene tramite il suo ID.
     * @param int $id L'ID dell'allergene.
     * @return EAllergens|null L'allergene trovato o null.
     */
    public static function getAllergenById(int $id): ?EAllergens
    {
        return FAllergens::getAllergenById($id);
    }

    /**
     * Elimina un allergene dal database.
     * @param EAllergens $allergen L'entità EAllergens da eliminare.
     * @return bool True in caso di successo.
     */
    public static function deleteAllergen(EAllergens $allergen): bool
    {
        return FAllergens::deleteObj($allergen);
    }

    /**
     * Associa un allergene a un prodotto.
     * @param EProduct $product L'oggetto prodotto.
     * @param EAllergens $allergen L'oggetto allergene.
     * @return bool True in caso di successo.
     */
    public static function addAllergenToProduct(EProduct $product, EAllergens $allergen): bool
    {
        $product->addAllergen($allergen);
        // Doctrine gestisce la persistenza della relazione bidirezionale
        // Il prodotto dovrebbe essere già gestito dall'EntityManager
        return FProduct::saveObj($product);
    }

    /**
     * Rimuove un allergene da un prodotto.
     * @param EProduct $product L'oggetto prodotto.
     * @param EAllergens $allergen L'oggetto allergene.
     * @return bool True in caso di successo.
     */
    public static function removeAllergenFromProduct(EProduct $product, EAllergens $allergen): bool
    {
        $product->removeAllergen($allergen);
        // Doctrine gestisce la persistenza della relazione bidirezionale
        return FProduct::saveObj($product);
    }

    // Aggiungi qui altri metodi statici per altre entità man mano che le sviluppi
}