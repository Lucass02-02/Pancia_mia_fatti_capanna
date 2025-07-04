<?php
namespace AppORM\Services\Foundation;

// La riga 'use' qui sotto è stata corretta da "AppORm" a "AppORM"
use AppORM\Services\Foundation\FEntityManager; 
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
        return FEntityManager::getInstance()->deleteObject($review); 
    }

    /**
     * Recupera tutte le recensioni presenti nel database.
     * Questa è la funzione che causava l'errore.
     * @return array Un array di oggetti EUserReview.
     */
    public static function fetchAll(): array
    {
        // Ora questa chiamata funzionerà perché il namespace in cima al file è corretto.
        return FEntityManager::getInstance()->selectAll(self::getTable());
    }
}