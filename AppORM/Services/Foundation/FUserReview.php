<?php
namespace AppORM\Services\Foundation;

use AppORm\Services\Foundation\FEntityManager;
use AppORM\Entity\EUserReview;
use AppORM\Entity\EClient;
use DateTime;

class FUserReview
{
    private static string $table = EUserReview::class; 
    private static string $key = "id";

    public static function getTable(): string { return self::$table; }
    public static function getKey(): string { return self::class; }
    public static function getClass(): string { return self::class; }

    public static function getObj(int $id): ?EUserReview
    {
        return FEntityManager::getInstance()->retriveObject(self::getTable(), $id);
    }

    public static function saveObj(EUserReview $review): bool
    {
        return FEntityManager::getInstance()->saveObject($review);
    }

    public static function deleteObj(EUserReview $review): bool
    {
        // Se FEntityManager non ha deleteObj, ma removeObject, usa quello
        return FEntityManager::getInstance()->deleteObject($review); 
    }

    /**
     * Recupera tutte le recensioni presenti nel database.
     * @return array Un array di oggetti EUserReview.
     */
    public static function fetchAll(): array
    {
        return FEntityManager::getInstance()->selectAll(self::getTable());
    }
}