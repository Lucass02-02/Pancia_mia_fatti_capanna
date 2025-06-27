<?php
// PHP Version: 8.1+

namespace App\Foundation;

use AppORM\Entity\EClient;
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
    private static string $table = "AppORM\\Entity\\EClient";
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
        return self::class;
    }

    public static function getClientByNickname(string $nickname): ?EClient
    {
        return FEntityManager::getInstance()->retriveObjectOnAttribute(self::getTable(), 'nickname', $nickname);
    }

    public static function getObj(int $id): ?EClient
    {
        return FEntityManager::getInstance()->retriveObject(self::getTable(), $id);
    }

    public static function getClientByNameSurname(string $name, string $surname): ?EClient
    {
        return FEntityManager::getInstance()->retriveObjOnTwoAttributes(self::getTable(), 'name', $name, 'surname', $surname);
    }

    public static function getObjByEmail(string $email): ?EClient
    {
        return FEntityManager::getInstance()->retriveObjectOnAttribute(self::getTable(), 'email', $email);
    }

    public static function saveObj(EClient $client): bool
    {
        return FEntityManager::getInstance()->saveObject($client);
    }

    public static function deleteObj(EClient $client): bool
    {
        return FEntityManager::getInstance()->deleteObj($client);
    }

    public static function checkEmailExists(string $email): bool
    {
        return FEntityManager::getInstance()->retriveObjectOnAttribute(self::getTable(), 'email', $email) !== null;
    }

    public static function getAllClients(): array
    {
        return FEntityManager::getInstance()->selectAll(self::getTable());
    }

    // --- Metodi per le funzionalità specifiche del cliente registrato (ereditati e specifici di EClient) ---

    public static function getId(EClient $client): ?int
    {
        return $client->getId();
    }

    public static function getName(EClient $client): string
    {
        return $client->getName();
    }

    public static function setName(EClient $client, string $name): void
    {
        $client->setName($name);
        self::saveObj($client);
    }

    public static function getSurname(EClient $client): string
    {
        return $client->getSurname();
    }

    public static function setSurname(EClient $client, string $surname): void
    {
        $client->setSurname($surname);
        self::saveObj($client);
    }

    public static function getBirthDate(EClient $client): DateTime
    {
        return $client->getBirthDate();
    }

    public static function setBirthDate(EClient $client, DateTime $birthDate): void
    {
        $client->setBirthDate($birthDate);
        self::saveObj($client);
    }

    public static function getEmail(EClient $client): string
    {
        return $client->getEmail();
    }

    public static function setEmail(EClient $client, string $email): void
    {
        $client->setEmail($email);
        self::saveObj($client);
    }

    public static function getPassword(EClient $client): string
    {
        return $client->getPassword();
    }

    public static function setPassword(EClient $client, string $hashedPassword): void
    {
        $client->setPassword($hashedPassword);
        self::saveObj($client);
    }

    public static function getPhonenumber(EClient $client): ?string
    {
        return $client->getPhonenumber();
    }

    public static function setPhonenumber(EClient $client, ?string $phonenumber): void
    {
        $client->setPhonenumber($phonenumber);
        self::saveObj($client);
    }

    public static function getNickname(EClient $client): ?string
    {
        return $client->getNickname();
    }

    public static function setNickname(EClient $client, ?string $nickname): void
    {
        $client->setNickname($nickname);
        self::saveObj($client);
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

    public static function setReceivesNotifications(EClient $client, bool $status): void
    {
        $client->setReceivesNotifications($status);
        self::saveObj($client);
    }

    public static function getReceivesNotifications(EClient $client): bool
    {
        return $client->getReceivesNotifications();
    }

    public static function getLoyaltyPoints(EClient $client): int
    {
        return $client->getLoyaltyPoints();
    }

    public static function setLoyaltyPoints(EClient $client, int $points): void
    {
        $client->setLoyaltyPoints($points);
        self::saveObj($client);
    }
}