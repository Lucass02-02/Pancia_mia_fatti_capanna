<?php
// PHP Version: 8.1+

namespace App\Foundation;

use AppORM\Entity\EAllergens; // Importa l'entità EAllergens
use AppORM\Entity\EProduct;   // Potrebbe essere necessario per le relazioni, se non già importato
use App\Foundation\FEntityManager; // Importa la classe FEntityManager per le operazioni ORM

/**
 * Classe Foundation per l'entità EAllergens.
 * Gestisce le operazioni di accesso ai dati (CRUD) per l'oggetto EAllergens
 * utilizzando solo metodi statici. Funge da interfaccia tra l'applicazione
 * e il gestore delle entità (FEntityManager).
 */
class FAllergens
{
    // *** CORREZIONE CRUCIALE QUI: Usa EAllergens::class per il nome della tabella/classe ***
    private static string $table = EAllergens::class;
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
     * Salva o aggiorna un oggetto EAllergens.
     * @param EAllergens $allergen L'entità EAllergens da salvare.
     * @return bool True in caso di successo.
     */
    public static function saveObj(EAllergens $allergen): bool
    {
        return FEntityManager::saveObject($allergen);
    }

    /**
     * Recupera un allergene tramite il suo ID.
     * @param int $id L'ID dell'allergene.
     * @return EAllergens|null L'allergene trovato o null.
     */
    public static function getAllergenById(int $id): ?EAllergens
    {
        return FEntityManager::retriveObject(self::getTable(), $id);
    }

    /**
     * Recupera un allergene tramite il suo tipo.
     * @param string $allergenType Il tipo di allergene.
     * @return EAllergens|null L'allergene trovato o null.
     */
    public static function getAllergenByType(string $allergenType): ?EAllergens
    {
        return FEntityManager::retriveObjectOnAttribute(self::getTable(), 'allergenType', $allergenType);
    }

    /**
     * Elimina un allergene dal database.
     * @param EAllergens $allergen L'entità EAllergens da eliminare.
     * @return bool True in caso di successo.
     */
    public static function deleteObj(EAllergens $allergen): bool
    {
        return FEntityManager::deleteObj($allergen);
    }

    /**
     * Seleziona tutti gli allergeni dal database.
     * @return EAllergens[] Un array di oggetti EAllergens.
     */
    public static function selectAll(): array
    {
        return FEntityManager::selectAll(self::getTable());
    }
}
