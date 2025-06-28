<?php
// PHP Version: 8.1+
// Questo file gestisce le operazioni di accesso ai dati per l'entità EProduct.

namespace App\Foundation;

use AppORM\Entity\EProduct; // Importa l'entità EProduct
use App\Foundation\FEntityManager; // Importa la classe FEntityManager per le operazioni ORM

/**
 * Classe Foundation per l'entità EProduct.
 * Gestisce le operazioni di accesso ai dati (CRUD) per l'oggetto EProduct
 * utilizzando solo metodi statici. Funge da interfaccia tra l'applicazione
 * e il gestore delle entità (FEntityManager).
 */
class FProduct {
    // *** CORREZIONE CRUCIALE QUI: Usa EProduct::class per il nome della tabella/classe ***
    private static string $table = EProduct::class;
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

    public static function saveObj(EProduct $product): bool
    {
        return FEntityManager::saveObject($product); // Modificato per usare il metodo statico
    }

    public static function getObj(int $id): ?EProduct
    {
        return FEntityManager::retriveObject(self::getTable(), $id); // Modificato per usare il metodo statico
    }

    public static function setAvailability(EProduct $product, bool $availability): bool
    {
        $product->setAvailability($availability);
        return self::saveObj($product);
    }

    public static function deleteObj(EProduct $product): bool
    {
        return FEntityManager::deleteObj($product); // Modificato per usare il metodo statico
    }

    public static function selectAll(): array
    {
        return FEntityManager::selectAll(self::getTable()); // Modificato per usare il metodo statico
    }
}
