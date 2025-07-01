<?php
// PHP Version: 8.1+

namespace AppORM\Services\Foundation; // MODIFICA: Namespace corretto

use AppORM\Entity\EClient;
use AppORM\Entity\ECreditCard;
use AppORM\Entity\EOrder;
use AppORM\Entity\EReservation;
use AppORM\Entity\EUserReview;
// MODIFICA: 'use' statement corretto per FEntityManager
use AppORM\Services\Foundation\FEntityManager; 
use Doctrine\Common\Collections\Collection;
use DateTime;

/**
 * Classe Foundation per l'entità EClient.
 * Gestisce le operazioni di accesso ai dati per l'oggetto EClient.
 */
class FClient
{
    private static string $table = EClient::class;
    private static string $key = "id";

    // --- NESSUN'ALTRA MODIFICA NECESSARIA QUI, LA LOGICA ERA GIÀ CORRETTA ---

    public static function getTable(): string { return self::$table; }
    public static function getKey(): string { return self::$key; }
    public static function getClass(): string { return self::class; }
    public static function saveObj(EClient $client): bool { return FEntityManager::saveObject($client); }
    public static function getObj(int $id): ?EClient { return FEntityManager::retriveObject(self::getTable(), $id); }
    public static function getClientByEmail(string $email): ?EClient { return FEntityManager::retriveObjectOnAttribute(self::getTable(), 'email', $email); }
    public static function getClientByNickname(string $nickname): ?EClient { return FEntityManager::retriveObjectOnAttribute(self::getTable(), 'nickname', $nickname); }
    public static function getClientByNameSurname(string $name, string $surname): ?EClient { return FEntityManager::retriveObjOnTwoAttributes(self::getTable(), 'name', $name, 'surname', $surname); }
    public static function deleteObj(EClient $client): bool { return FEntityManager::deleteObj($client); }
    public static function selectAll(): array { return FEntityManager::selectAll(self::getTable()); }
    public static function setPhonenumber(EClient $client, ?string $phonenumber): bool { $client->setPhonenumber($phonenumber); return self::saveObj($client); }
    public static function setNickname(EClient $client, ?string $nickname): bool { $client->setNickname($nickname); return self::saveObj($client); }
    public static function setReceivesNotifications(EClient $client, bool $status): bool { $client->setReceivesNotifications($status); return self::saveObj($client); }
    public static function setLoyaltyPoints(EClient $client, int $points): bool { $client->setLoyaltyPoints($points); return self::saveObj($client); }
    public static function getReviews(EClient $client): Collection { return $client->getReviews(); }
    public static function getCreditCards(EClient $client): Collection { return $client->getCreditCards(); }
    public static function getReservations(EClient $client): Collection { return $client->getReservations(); }
    public static function getOrders(EClient $client): Collection { return $client->getOrders(); }
}