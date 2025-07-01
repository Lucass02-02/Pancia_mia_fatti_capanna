<?php
// PHP Version: 8.1+

namespace AppORM\Services\Foundation; // MODIFICA: Namespace corretto

use AppORM\Entity\EProduct;
// MODIFICA: 'use' statement corretto per FEntityManager
use AppORM\Services\Foundation\FEntityManager; 

/**
 * Classe Foundation per l'entità EProduct.
 */
class FProduct 
{
    private static string $table = EProduct::class;
    private static string $key = "id";

    // --- NESSUN'ALTRA MODIFICA NECESSARIA QUI, LA LOGICA ERA GIÀ CORRETTA ---

    public static function getTable(): string { return self::$table; }
    public static function getKey(): string { return self::$key; }
    public static function getClass(): string { return self::class; }
    public static function saveObj(EProduct $product): bool { return FEntityManager::saveObject($product); }
    public static function getObj(int $id): ?EProduct { return FEntityManager::retriveObject(self::getTable(), $id); }
    public static function setAvailability(EProduct $product, bool $availability): bool { $product->setAvailability($availability); return self::saveObj($product); }
    public static function deleteObj(EProduct $product): bool { return FEntityManager::deleteObj($product); }
    public static function selectAll(): array { return FEntityManager::selectAll(self::getTable()); }
}