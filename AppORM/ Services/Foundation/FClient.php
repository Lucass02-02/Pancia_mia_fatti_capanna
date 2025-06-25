<?php

namespace App\Foundation; // Il namespace deve essere la prima cosa

use AppORM\Entity\EClient;
use AppORM\Entity\ECreditCard;
use AppORM\Entity\EOrder;
use AppORM\Entity\EReservation;
use AppORM\Entity\EUserReview;
use App\EntityManager\FEntityManager;
use Doctrine\Common\Collections\Collection;

/**
 * Classe Foundation per l'entità EClient.
 * Gestisce le operazioni di accesso ai dati per l'oggetto EClient utilizzando solo metodi statici.
 */
class FClient
{
    // Nome completo della classe dell'entità Doctrine che questa Foundation gestisce.
    private static string $table = "AppORM\\Entity\\EClient";
    // Chiave primaria dell'entità Client, per riferimento.
    private static string $key = "id";

    /**
     * Restituisce il nome completo della classe dell'entità gestita.
     * @return string
     */
    public static function getTable(): string
    {
        return self::$table;
    }

    /**
     * Restituisce il nome della chiave primaria dell'entità.
     * @return string
     */
    public static function getKey(): string
    {
        return self::$key;
    }

    /**
     * Restituisce il nome della classe Foundation corrente (FClient).
     * @return string
     */
    public static function getClass(): string
    {
        return self::class;
    }

    /**
     * Recupera un oggetto EClient tramite il suo nickname.
     * @param string $nickname Il nickname del cliente.
     * @return EClient|null L'oggetto EClient se trovato, altrimenti null.
     */
    public static function getClientByNickname(string $nickname): ?EClient
    {
        return FEntityManager::getInstance()->retriveObjectOnAttribute(self::getTable(), 'nickname', $nickname);
    }

    /**
     * Recupera un oggetto EClient tramite il suo ID.
     * Delega a FEntityManager::retriveObject.
     * @param int $id L'ID del cliente.
     * @return EClient|null L'oggetto EClient se trovato, altrimenti null.
     */
    public static function getObj(int $id): ?EClient
    {
        return FEntityManager::getInstance()->retriveObject(self::getTable(), $id);
    }

    /**
     * Recupera un oggetto EClient tramite nome e cognome.
     * @param string $name Il nome del cliente.
     * @param string $surname Il cognome del cliente.
     * @return EClient|null L'oggetto EClient se trovato, altrimenti null.
     */
    public static function getClientByNameSurname(string $name, string $surname): ?EClient
    {
        // Usa il metodo con il nome corretto come presente in FEntityManager originale
        return FEntityManager::getInstance()->retriveObjOnTwoAttributes(self::getTable(), 'name', $name, 'surname', $surname);
    }

    /**
     * Recupera un oggetto EClient tramite la sua email.
     * Delega a FEntityManager::retriveObjectOnAttribute.
     * @param string $email L'indirizzo email del cliente.
     * @return EClient|null L'oggetto EClient se trovato, altrimenti null.
     */
    public static function getByEmail(string $email): ?EClient
    {
        return FEntityManager::getInstance()->retriveObjectOnAttribute(self::getTable(), 'email', $email);
    }

    /**
     * Salva o aggiorna un oggetto EClient nel database.
     * Delega a FEntityManager::saveObject.
     * @param EClient $client L'entità EClient da salvare.
     * @return bool True in caso di successo, false in caso di errore.
     */
    public static function saveObj(EClient $client): bool
    {
        return FEntityManager::getInstance()->saveObject($client);
    }

    /**
     * Elimina un oggetto EClient dal database.
     * Delega a FEntityManager::deleteObj.
     * @param EClient $client L'entità EClient da eliminare.
     * @return bool True in caso di successo, false in caso di errore.
     */
    public static function deleteObj(EClient $client): bool
    {
        return FEntityManager::getInstance()->deleteObj($client);
    }

    /**
     * Controlla se un'email esiste già nel database per un EClient.
     * Delega a FEntityManager::retriveObjectOnAttribute.
     * @param string $email L'email da controllare.
     * @return bool True se l'email esiste, false altrimenti.
     */
    public static function checkEmail(string $email): bool
    {
        return FEntityManager::getInstance()->retriveObjectOnAttribute(self::getTable(), 'email', $email) !== null;
    }

    // --- Metodi per le funzionalità specifiche del cliente registrato ---
    // Riflettono le proprietà di EClient ed EUser.

    /**
     * Recupera i metodi di pagamento salvati per un cliente.
     * Riflette la proprietà 'savedMethods' di EClient.
     * @param EClient $client L'oggetto EClient.
     * @return array
     */
    public static function getSavedMethods(EClient $client): array
    {
        return $client->getSavedMethods();
    }

    /**
     * Imposta i metodi di pagamento salvati per un cliente e salva nel DB.
     * Riflette la proprietà 'savedMethods' di EClient.
     * @param EClient $client L'oggetto EClient.
     * @param array $savedMethods
     */
    public static function setSavedMethods(EClient $client, array $savedMethods): void
    {
        $client->setSavedMethods($savedMethods);
        self::saveObj($client);
    }

    /**
     * Recupera il nickname per un cliente.
     * Riflette la proprietà 'nickname' di EClient.
     * @param EClient $client L'oggetto EClient.
     * @return string|null
     */
    public static function getNickname(EClient $client): ?string
    {
        return $client->getNickname();
    }

    /**
     * Imposta il nickname per un cliente e salva nel DB.
     * Riflette la proprietà 'nickname' di EClient.
     * @param EClient $client L'oggetto EClient.
     * @param string|null $nickname
     */
    public static function setNickname(EClient $client, ?string $nickname): void
    {
        $client->setNickname($nickname);
        self::saveObj($client);
    }

    /**
     * Recupera le carte di credito associate a un cliente.
     * Riflette la relazione 'creditCards' di EClient.
     * @param EClient $client L'oggetto EClient.
     * @return Collection<int, ECreditCard>
     */
    public static function getCreditCards(EClient $client): Collection
    {
        return $client->getCreditCards();
    }

    /**
     * Recupera le prenotazioni associate a un cliente.
     * Riflette la relazione 'reservations' di EClient.
     * @param EClient $client L'oggetto EClient.
     * @return Collection<int, EReservation>
     */
    public static function getReservations(EClient $client): Collection
    {
        return $client->getReservations();
    }

    /**
     * Recupera gli ordini associati a un cliente.
     * Riflette la relazione 'orders' di EClient.
     * @param EClient $client L'oggetto EClient.
     * @return Collection<int, EOrder>
     */
    public static function getOrders(EClient $client): Collection
    {
        return $client->getOrders();
    }


    // --- Metodi ereditati da EUser ---
    // Questi metodi interagiscono direttamente con l'oggetto EClient passato.
    // Non delegano a PersistentManager o FEntityManager per operazioni CRUD qui,
    // ma usano FClient::saveObj per salvare le modifiche all'oggetto.

    /**
     * Restituisce l'ID dell'utente.
     * @param EClient $client
     * @return int|null
     */
    public static function getId(EClient $client): ?int
    {
        return $client->getId();
    }

    /**
     * Restituisce il nome dell'utente.
     * @param EClient $client
     * @return string|null
     */
    public static function getName(EClient $client): ?string
    {
        return $client->getName();
    }

    /**
     * Imposta il nome dell'utente e salva nel DB.
     * @param EClient $client
     * @param string $name
     */
    public static function setName(EClient $client, string $name): void
    {
        $client->setName($name);
        self::saveObj($client);
    }

    /**
     * Restituisce il cognome dell'utente.
     * @param EClient $client
     * @return string|null
     */
    public static function getSurname(EClient $client): ?string
    {
        return $client->getSurname();
    }

    /**
     * Imposta il cognome dell'utente e salva nel DB.
     * @param EClient $client
     * @param string $surname
     */
    public static function setSurname(EClient $client, string $surname): void
    {
        $client->setSurname($surname);
        self::saveObj($client);
    }

    /**
     * Restituisce la data di nascita dell'utente.
     * @param EClient $client
     * @return \DateTimeInterface|null
     */
    public static function getBirthDate(EClient $client): ?\DateTimeInterface
    {
        return $client->getBirthDate();
    }

    /**
     * Imposta la data di nascita dell'utente e salva nel DB.
     * @param EClient $client
     * @param \DateTimeInterface $birthDate
     */
    public static function setBirthDate(EClient $client, \DateTimeInterface $birthDate): void
    {
        $client->setBirthDate($birthDate);
        self::saveObj($client);
    }

    /**
     * Restituisce l'email dell'utente.
     * @param EClient $client
     * @return string|null
     */
    public static function getEmail(EClient $client): ?string
    {
        return $client->getEmail();
    }

    /**
     * Imposta l'email dell'utente e salva nel DB.
     * @param EClient $client
     * @param string $email
     */
    public static function setEmail(EClient $client, string $email): void
    {
        $client->setEmail($email);
        self::saveObj($client);
    }

    /**
     * Restituisce la password dell'utente.
     * @param EClient $client
     * @return string|null
     */
    public static function getPassword(EClient $client): ?string
    {
        return $client->getPassword();
    }

    /**
     * Imposta la password dell'utente e salva nel DB.
     * @param EClient $client
     * @param string $password
     */
    public static function setPassword(EClient $client, string $password): void
    {
        $client->setPassword($password);
        self::saveObj($client);
    }

    /**
     * Restituisce il numero di telefono dell'utente.
     * @param EClient $client
     * @return string|null
     */
    public static function getPhonenumber(EClient $client): ?string
    {
        return $client->getPhonenumber();
    }

    /**
     * Imposta il numero di telefono dell'utente e salva nel DB.
     * @param EClient $client
     * @param string|null $phonenumber
     */
    public static function setPhonenumber(EClient $client, ?string $phonenumber): void
    {
        $client->setPhonenumber($phonenumber);
        self::saveObj($client);
    }
}
