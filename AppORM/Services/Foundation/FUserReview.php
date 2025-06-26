<?php

namespace App\Foundation;

use AppORM\Entity\EUserReview; // Importa la tua entità EUserReview
use AppORM\Entity\EClient;    // Importa EClient se necessario per query incrociate
use App\Foundation\FEntityManager; // Corretto il namespace per FEntityManager
use \DateTime; // AGGIUNTA FONDAMENTALE: Nota il backslash iniziale

/**
 * Classe Foundation per l'entità EUserReview.
 * Gestisce le operazioni di accesso ai dati per l'oggetto EUserReview utilizzando solo metodi statici.
 */
class FUserReview
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

    /**
     * Calcola il voto medio per un cliente specifico o per tutte le recensioni.
     * @param EClient|null $client L'oggetto EClient per cui calcolare la media, o null per la media complessiva.
     * @return float Il voto medio.
     */
    public static function getAverageRating(?EClient $client = null): float
    {
        $reviews = [];
        if ($client) {
            $reviews = self::getReviewsByClient($client);
        } else {
            $reviews = FEntityManager::getInstance()->selectAll(self::getTable());
        }

        if (empty($reviews)) {
            return 0.0;
        }

        $totalVote = 0;
        foreach ($reviews as $review) {
            $totalVote += $review->getVote();
        }

        return $totalVote / count($reviews);
    }

    /**
     * Recupera le X recensioni più recenti.
     * Questa implementazione recupera tutto e poi ordina in PHP.
     * Per un grande numero di recensioni, sarebbe meglio aggiungere un metodo orderBy
     * in FEntityManager con DQL o configurare un indice di Doctrine.
     * @param int $limit Il numero massimo di recensioni da recuperare.
     * @return EUserReview[] Un array di oggetti EUserReview ordinati per data e ora decrescenti.
     */
    public static function getLatestReviews(int $limit = 10): array
    {
        $reviews = FEntityManager::getInstance()->selectAll(self::getTable());

        usort($reviews, function (EUserReview $a, EUserReview $b) {
            $dateTimeA = new \DateTime($a->getDate()->format('Y-m-d') . ' ' . $a->getHour()->format('H:i:s'));
            $dateTimeB = new \DateTime($b->getDate()->format('Y-m-d') . ' ' . $b->getHour()->format('H:i:s'));
            return $dateTimeB <=> $dateTimeA;
        });

        return array_slice($reviews, 0, $limit);
    }

    // Placeholder per futuri metodi (es. per risposte admin)
    // public static function getReviewsWithoutAdminResponse(): array { return []; }
    // public static function getReviewsWithAdminResponse(): array { return []; }
}
