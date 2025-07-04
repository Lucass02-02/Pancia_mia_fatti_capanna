<?php

namespace AppORM\Services\Foundation; 

use AppORM\Entity\ECreditCard; 
use AppORM\Services\Foundation\FEntityManager; 
use DateTime;

/**
 * Classe Foundation per l'entità ECreditCard.
 * Gestisce le operazioni di accesso ai dati (CRUD) per l'oggetto ECreditCard.
 */
class FCreditCard
{
    // Usa ECreditCard::class per passare il nome corretto della classe a Doctrine
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
        return FEntityManager::getInstance()->saveObject($creditCard);
    }

    /**
     * Recupera una carta di credito tramite il suo ID.
     * @param int $id L'ID della carta di credito.
     * @return ECreditCard|null La carta di credito trovata o null.
     */
    public static function getObj(int $id): ?ECreditCard
    {
        return FEntityManager::getInstance()->retriveObject(self::getTable(), $id);
    }

    /**
     * Elimina una carta di credito dal database.
     * @param ECreditCard $creditCard L'entità ECreditCard da eliminare.
     * @return bool True in caso di successo.
     */
    public static function deleteObj(ECreditCard $creditCard): bool
    {
        return FEntityManager::getInstance()->deleteObject($creditCard);
    }

    /**
     * Seleziona tutte le carte di credito dal database.
     * @return ECreditCard[] Un array di oggetti ECreditCard.
     */
    public static function selectAll(): array
    {
        return FEntityManager::getInstance()->selectAll(self::getTable());
    }
}
