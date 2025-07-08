<?php

namespace AppORM\Services\Foundation;

use AppORM\Entity\EProduct;
use AppORM\Services\Foundation\FEntityManager; 

class FProduct 
{
    private static string $table = EProduct::class;
    private static string $key = "id";

    public static function getTable(): string { return self::$table; }
    public static function getKey(): string { return self::$key; }
    public static function getClass(): string { return self::class; }
    public static function saveObj(EProduct $product): bool { return FEntityManager::getInstance()->saveObject($product); }
    public static function getObj(int $id): ?EProduct { return FEntityManager::getInstance()->retriveObject(self::getTable(), $id); }
    public static function setAvailability(EProduct $product, bool $availability): bool { $product->setAvailability($availability); return self::saveObj($product); }
    public static function deleteObj(EProduct $product): bool { return FEntityManager::getInstance()->deleteObject($product); }
    public static function selectAll(): array { return FEntityManager::getInstance()->selectAll(self::getTable()); }
    public static function fetchAll(): array{ return FEntityManager::getInstance()->selectAll(EProduct::class);}
    public static function getAvailableProducts(): array
    {
        $allProducts = self::fetchAll();
        $availableProducts = [];
        foreach ($allProducts as $product) {
            if ($product->isAvailable()) {
                $availableProducts[] = $product;
            }
        }
        return $availableProducts;
    }
}