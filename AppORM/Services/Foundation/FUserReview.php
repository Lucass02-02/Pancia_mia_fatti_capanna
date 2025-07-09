<?php
namespace AppORM\Services\Foundation;

use AppORM\Services\Foundation\FEntityManager;
use AppORM\Entity\EUserReview;
use AppORM\Entity\EClient; // Assicurati sia presente se usato altrove
use DateTime; // Assicurati sia presente se usato altrove

class FUserReview
{
    private static string $table = EUserReview::class;
    private static string $key = "id"; // Questa proprietà non è usata in questo file se non direttamente

    public static function getTable(): string { return self::$table; }
    // Rimosse o commentate le righe che sembravano ridondanti/errate
    // public static function getKey(): string { return self::class; }
    // public static function getClass(): string { return self::class; }

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
     * Implementa il JOIN FETCH per le risposte dell'admin.
     * @return array Un array di oggetti EUserReview.
     */
      public static function fetchAll(): array
    {
        $em = FEntityManager::getInstance()->getEntityManager(); // Ottieni l'EntityManager
        $queryBuilder = $em->createQueryBuilder(); // Crea il QueryBuilder

        $queryBuilder->select('r', 'ar', 'a') // Seleziona recensione ('r'), risposte admin ('ar') e l'admin che risponde ('a')
                     ->from(self::$table, 'r') // Specifica l'entità principale
                     ->leftJoin('r.adminResponses', 'ar') // Esegue un JOIN FETCH per caricare le risposte dell'admin
                     ->leftJoin('ar.admin', 'a'); // Esegue un JOIN FETCH per caricare l'admin associato a ogni risposta

        return $queryBuilder->getQuery()->getResult(); // Esegue la query e restituisce il risultato
    }
}