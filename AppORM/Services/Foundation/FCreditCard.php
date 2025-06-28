<?php
// PHP Version: 8.1+

namespace App\Foundation;

use AppORM\Entity\ECreditCard; // Assicurati che ECreditCard sia importato correttamente
use App\Foundation\FEntityManager;
use DateTime; // Potrebbe non servire qui, ma lascialo se usato altrove

/**
 * Classe Foundation per l'entità ECreditCard.
 * Gestisce le operazioni di accesso ai dati (CRUD) per l'oggetto ECreditCard
 * utilizzando solo metodi statici. Funge da interfaccia tra l'applicazione
 * e il gestore delle entità (FEntityManager).
 */
class FCreditCard
{
    // *** CORREZIONE CRUCIALE QUI: Usa ECreditCard::class per il nome della tabella/classe ***
    // Questo garantisce che il nome della classe sia passato a Doctrine con backslash singoli
    private static string $table = ECreditCard::class; 
    private static string $key = "id";

    public static function getTable(): string
    {
        return self::$table;
    }

    public static function getKey(): string
    {
        return self::$key;
    }

    // Il metodo getClass() restituirà il nome della classe Foundation (FCreditCard),
    // non il nome della classe dell'entità mappata. Se hai bisogno del nome dell'entità, usa getTable().
    public static function getClass(): string
    {
        return self::class;
    }

    /**
     * Salva o aggiorna un oggetto ECreditCard.
     * @param ECreditCard $creditCard L'entità ECreditCard da salvare.
     * @return bool True in caso di successo.
     */
    public static function saveObj(ECreditCard $creditCard): bool
    {
        return FEntityManager::saveObject($creditCard);
    }

    /**
     * Recupera una carta di credito tramite il suo ID.
     * @param int $id L'ID della carta di credito.
     * @return ECreditCard|null La carta di credito trovata o null.
     */
    public static function getObj(int $id): ?ECreditCard
    {
        return FEntityManager::retriveObject(self::getTable(), $id);
    }

    /**
     * Elimina una carta di credito dal database.
     * @param ECreditCard $creditCard L'entità ECreditCard da eliminare.
     * @return bool True in caso di successo.
     */
    public static function deleteObj(ECreditCard $creditCard): bool
    {
        return FEntityManager::deleteObj($creditCard);
    }

    /**
     * Seleziona tutte le carte di credito dal database.
     * @return ECreditCard[] Un array di oggetti ECreditCard.
     */
    public static function selectAll(): array
    {
        return FEntityManager::selectAll(self::getTable());
    }

    // Aggiungi qui altri metodi statici per operazioni specifiche su ECreditCard se necessario
}
