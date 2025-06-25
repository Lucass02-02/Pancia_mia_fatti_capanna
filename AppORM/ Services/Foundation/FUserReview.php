<?php

namespace App\Foundation;

use AppORM\Entity\EUserReview; // Importa la tua entità EUserReview
use AppORM\Entity\EClient;    // Importa EClient se necessario per query incrociate
use App\EntityManager\FEntityManager; // Importa la tua FEntityManager

/**
 * Classe Foundation per l'entità EUserReview.
 * Gestisce le operazioni di accesso ai dati per l'oggetto EUserReview utilizzando solo metodi statici.
 */
class FUserReview // Nome corretto della classe
{
    private static string $table = "AppORM\\Entity\\EUserReview"; // Nome completo della classe dell'entità Doctrine
    private static string $key = "id"; // Chiave primaria della recensione

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
     * Restituisce il nome della classe Foundation corrente (FUserReview).
     * @return string
     */
    public static function getClass(): string
    {
        return self::class;
    }

    /**
     * Recupera un oggetto EUserReview tramite il suo ID.
     * @param int $id L'ID della recensione.
     * @return EUserReview|null
     */
    public static function getObj(int $id): ?EUserReview
    {
        return FEntityManager::getInstance()->retriveObject(self::getTable(), $id);
    }

    /**
     * Salva o aggiorna un oggetto EUserReview.
     * @param EUserReview $review L'entità EUserReview da salvare.
     * @return bool True in caso di successo.
     */
    public static function saveObj(EUserReview $review): bool
    {
        return FEntityManager::getInstance()->saveObject($review);
    }

    /**
     * Elimina un oggetto EUserReview.
     * @param EUserReview $review L'entità EUserReview da eliminare.
     * @return bool True in caso di successo.
     */
    public static function deleteObj(EUserReview $review): bool
    {
        return FEntityManager::getInstance()->deleteObj($review);
    }

    /**
     * Recupera tutte le recensioni lasciate da un Cliente specifico.
     * Utilizza FEntityManager::retriveObjectList.
     * @param EClient $client L'oggetto EClient per cui recuperare le recensioni.
     * @return EUserReview[] Un array di oggetti EUserReview.
     */
    public static function getReviewsByClient(EClient $client): array
    {
        // Il campo 'user' nell'entità EUserReview è l'associazione al cliente.
        // Assicurati che 'id' sia il nome del campo ID dell'entità EClient.
        return FEntityManager::getInstance()->retriveObjectList(self::getTable(), 'user', $client->getId());
    }

    /**
     * Recupera le recensioni in base al voto.
     * @param int $vote Il voto delle recensioni da recuperare.
     * @return EUserReview[] Un array di oggetti EUserReview.
     */
    public static function getReviewsByVote(int $vote): array
    {
        return FEntityManager::getInstance()->retriveObjectList(self::getTable(), 'vote', $vote);
    }

    // Aggiungi qui altri metodi specifici per le recensioni, ad esempio:
    // public static function getAverageRating(EClient $client): float { ... }
    // public static function getLatestReviews(int $limit): array { ... }
}
