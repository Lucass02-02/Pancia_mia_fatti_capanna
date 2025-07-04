<?php
// File: AppORM/Services/Foundation/FProductCategory.php

namespace AppORM\Services\Foundation;

use AppORM\Entity\EProductCategory;
use AppORM\Services\Foundation\FEntityManager;

/**
 * Classe Foundation che gestisce le operazioni di accesso al database
 * per l'entità EProductCategory.
 */
class FProductCategory
{
    private static string $table = EProductCategory::class;

    /**
     * Salva o aggiorna un oggetto EProductCategory.
     */
    public static function saveObj(EProductCategory $category): bool
    {
        return FEntityManager::getInstance()->saveObject($category);
    }

    /**
     * Recupera una categoria tramite il suo ID.
     */
    public static function getObj(int $id): ?EProductCategory
    {
        return FEntityManager::getInstance()->retriveObject(self::$table, $id);
    }

    /**
     * Recupera tutte le categorie dal database.
     */
    public static function selectAll(): array
    {
        return FEntityManager::getInstance()->selectAll(self::$table);
    }

    /**
     * Cancella una categoria dal database.
     */
    public static function deleteObj(EProductCategory $category): bool
    {
        return FEntityManager::getInstance()->deleteObject($category);
    }
}