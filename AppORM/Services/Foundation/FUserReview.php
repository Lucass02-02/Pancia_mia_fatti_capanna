<?php
namespace AppORM\Services\Foundation;

<<<<<<< Updated upstream
=======
// La riga 'use' qui sotto è stata corretta da "AppORm" a "AppORM"
use AppORM\Services\Foundation\FEntityManager; 
>>>>>>> Stashed changes
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
        return FEntityManager::retriveObject(self::getTable(), $id);
    }

    public static function saveObj(EUserReview $review): bool
    {
        return FEntityManager::saveObject($review);
    }

    public static function deleteObj(EUserReview $review): bool
    {
<<<<<<< Updated upstream
        // Se FEntityManager non ha deleteObj, ma removeObject, usa quello
        return FEntityManager::removeObject($review); 
=======
        return FEntityManager::getInstance()->deleteObject($review); 
>>>>>>> Stashed changes
    }

    /**
     * Recupera tutte le recensioni presenti nel database.
     * Questa è la funzione che causava l'errore.
     * @return array Un array di oggetti EUserReview.
     */
    public static function fetchAll(): array
    {
<<<<<<< Updated upstream
        return FEntityManager::retrieveAll(self::getTable());
=======
        // Ora questa chiamata funzionerà perché il namespace in cima al file è corretto.
        return FEntityManager::getInstance()->selectAll(self::getTable());
>>>>>>> Stashed changes
    }
}