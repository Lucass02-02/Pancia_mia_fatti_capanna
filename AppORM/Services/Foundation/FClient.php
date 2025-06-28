<?php
// PHP Version: 8.1+

namespace App\Foundation;

use AppORM\Entity\EClient; // Assicurati che EClient sia importato correttamente
use AppORM\Entity\ECreditCard;
use AppORM\Entity\EOrder;
use AppORM\Entity\EReservation;
use AppORM\Entity\EUserReview;
use App\Foundation\FEntityManager;
use Doctrine\Common\Collections\Collection;
use DateTime;

/**
 * Classe Foundation per l'entità EClient.
 * Gestisce le operazioni di accesso ai dati per l'oggetto EClient utilizzando solo metodi statici.
 * I metodi setter di questa classe salvano immediatamente le modifiche al database.
 */
class FClient
{
    // *** CORREZIONE CRUCIALE QUI: Usa EClient::class per il nome della tabella/classe ***
    private static string $table = EClient::class; // Ora sarà 'AppORM\Entity\EClient' con backslash singoli
    private static string $key = "id";

    public static function getTable(): string
    {
        return self::$table;
    }

    public static function getKey(): string
    {
        return self::$key;
    }

    public static function getClass(): string
    {
        // Questo metodo dovrebbe restituire il nome della classe Foundation, non dell'entità
        // Se intendi la classe dell'entità, usa getTable()
        return self::class;
    }

    /**
     * Salva o aggiorna un oggetto EClient.
     * @param EClient $client L'entità EClient da salvare.
     * @return bool True in caso di successo.
     */
    public static function saveObj(EClient $client): bool
    {
        return FEntityManager::saveObject($client); // Modificato per usare il metodo statico
    }

    /**
     * Recupera un cliente tramite il suo ID.
     * @param int $id L'ID del cliente.
     * @return EClient|null Il cliente trovato o null.
     */
    public static function getObj(int $id): ?EClient
    {
        return FEntityManager::retriveObject(self::getTable(), $id); // Modificato per usare il metodo statico
    }

    /**
     * Recupera un cliente tramite la sua email.
     * @param string $email L'email del cliente.
     * @return EClient|null Il cliente trovato o null.
     */
    public static function getClientByEmail(string $email): ?EClient
    {
        return FEntityManager::retriveObjectOnAttribute(self::getTable(), 'email', $email); // Modificato per usare il metodo statico
    }

    /**
     * Recupera un cliente tramite il suo nickname.
     * @param string $nickname Il nickname del cliente.
     * @return EClient|null Il cliente trovato o null.
     */
    public static function getClientByNickname(string $nickname): ?EClient
    {
        return FEntityManager::retriveObjectOnAttribute(self::getTable(), 'nickname', $nickname); // Modificato per usare il metodo statico
    }

    /**
     * Recupera un cliente tramite nome e cognome.
     * @param string $name Il nome del cliente.
     * @param string $surname Il cognome del cliente.
     * @return EClient|null Il cliente trovato o null.
     */
    public static function getClientByNameSurname(string $name, string $surname): ?EClient
    {
        return FEntityManager::retriveObjOnTwoAttributes(self::getTable(), 'name', $name, 'surname', $surname); // Modificato per usare il metodo statico
    }

    /**
     * Elimina un cliente dal database.
     * @param EClient $client L'entità EClient da eliminare.
     * @return bool True in caso di successo.
     */
    public static function deleteObj(EClient $client): bool
    {
        return FEntityManager::deleteObj($client); // Modificato per usare il metodo statico
    }

    /**
     * Seleziona tutti i clienti dal database.
     * @return EClient[] Un array di oggetti EClient.
     */
    public static function selectAll(): array
    {
        return FEntityManager::selectAll(self::getTable()); // Modificato per usare il metodo statico
    }

    // Metodi per aggiornare attributi specifici e salvarli immediatamente
    public static function setPhonenumber(EClient $client, ?string $phonenumber): bool
    {
        $client->setPhonenumber($phonenumber);
        return self::saveObj($client);
    }

    public static function setNickname(EClient $client, ?string $nickname): bool
    {
        $client->setNickname($nickname);
        return self::saveObj($client);
    }

    public static function setReceivesNotifications(EClient $client, bool $status): bool
    {
        $client->setReceivesNotifications($status);
        return self::saveObj($client);
    }

    public static function setLoyaltyPoints(EClient $client, int $points): bool
    {
        $client->setLoyaltyPoints($points);
        return self::saveObj($client);
    }

    // Metodi per recuperare relazioni
    public static function getReviews(EClient $client): Collection
    {
        return $client->getReviews();
    }

    public static function getCreditCards(EClient $client): Collection
    {
        return $client->getCreditCards();
    }

    public static function getReservations(EClient $client): Collection
    {
        return $client->getReservations();
    }

    public static function getOrders(EClient $client): Collection
    {
        return $client->getOrders();
    }
}
