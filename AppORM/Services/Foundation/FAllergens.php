<?php

namespace AppORM\Services\Foundation;

use AppORM\Entity\EAllergens;
use AppORM\Services\Foundation\FEntityManager; 

/**
 * Classe Foundation per l'entità EAllergens.
 */
class FAllergens
{
    private static string $table = EAllergens::class;
    private static string $key = "id";

    

    /**
     * Restituisce il nome della classe dell'entità gestita.
     * @return string
     */
    public static function getTable(): string
    {
        return self::$table; // Restituisce la proprietà statica $table
    }

    /**
     * Restituisce il nome della chiave primaria dell'entità.
     * @return string
     */
    public static function getKey(): string
    {
        return self::$key; // Restituisce la proprietà statica $key
    }

    /**
     * Restituisce il nome della classe Foundation corrente.
     * @return string
     */
    public static function getClass(): string
    {
        return self::class; // Restituisce il nome di questa classe (FAllergens)
    }


    /**
     * Salva o aggiorna un oggetto EAllergens.
     * @param EAllergens $allergen L'entità EAllergens da salvare.
     * @return bool True in caso di successo.
     */
    public static function saveObj(EAllergens $allergen): bool
    {
        return FEntityManager::getInstance()->saveObject($allergen);
    }

    /**
     * Recupera un allergene tramite il suo ID.
     * @param int $id L'ID dell'allergene.
     * @return EAllergens|null L'allergene trovato o null.
     */
    public static function getAllergenById(int $id): ?EAllergens
    {
        return FEntityManager::getInstance()->retriveObject(self::getTable(), $id);
    }

    /**
     * Recupera un allergene tramite il suo tipo.
     * @param string $allergenType Il tipo di allergene.
     * @return EAllergens|null L'allergene trovato o null.
     */
    public static function getAllergenByType(string $allergenType): ?EAllergens
    {
        return FEntityManager::getInstance()->retriveObjectOnAttribute(self::getTable(), 'allergenType', $allergenType);
    }

    /**
     * Elimina un allergene dal database.
     * @param EAllergens $allergen L'entità EAllergens da eliminare.
     * @return bool True in caso di successo.
     */
    public static function deleteObj(EAllergens $allergen): bool
    {
        return FEntityManager::getInstance()->deleteObject($allergen);
    }

    /**
     * Seleziona tutti gli allergeni dal database.
     * @return array
     */
    public static function selectAll(): array
    {
        return FEntityManager::getInstance()->selectAll(self::getTable());
    }

    
     public static function fetchAll(): array
    {
        return FEntityManager::getInstance()->selectAll(EAllergens::class);
    }
}
