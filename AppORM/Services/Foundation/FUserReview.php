<?php
namespace AppORM\Services\Foundation; 

use AppORM\Entity\EUserReview;
use AppORM\Entity\EClient;
use DateTime;

class FUserReview
{
    private static string $table = EUserReview::class; 
    private static string $key = "id";

    public static function getTable(): string { return self::$table; }
    public static function getKey(): string { return self::$key; }
    public static function getClass(): string { return self::class; }


    public static function getObj(int $id): ?EUserReview
    {
        return FEntityManager::retriveObject(self::getTable(), $id);
    }

    public static function saveObj(EUserReview $review): bool
    {
        return FEntityManager::saveObject($review);
    }

    public static function deleteObj(EUserReview $review): bool
    {
        return FEntityManager::deleteObj($review);
    }

    public static function getReviewsByClient(EClient $client): array
    {
        return FEntityManager::retriveObjectList(self::getTable(), 'user', $client->getId());
    }
}