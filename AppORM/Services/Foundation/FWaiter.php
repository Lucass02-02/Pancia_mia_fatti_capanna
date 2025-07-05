<?php
// File: AppORM/Services/Foundation/FWaiter.php (CODICE CORRETTO)
namespace AppORM\Services\Foundation;

use AppORM\Entity\EWaiter;

class FWaiter
{
    /**
     * Salva o aggiorna un oggetto EWaiter nel database.
     */
    public static function saveObj(EWaiter $waiter): bool {
        return FEntityManager::getInstance()->saveObject($waiter);
    }

    /**
     * Recupera un cameriere tramite il suo ID.
     */
    public static function getObj(int $id): ?EWaiter {
        return FEntityManager::getInstance()->retriveObject(EWaiter::class, $id);
    }

    /**
     * Cancella un cameriere dal database.
     */
    public static function deleteObj(EWaiter $waiter): bool {
        return FEntityManager::getInstance()->deleteObject($waiter);
    }

    /**
     * Recupera tutti i camerieri dal database.
     */
    public static function selectAll(): array {
        return FEntityManager::getInstance()->selectAll(EWaiter::class);
    }
    
    /**
     * Recupera un cameriere tramite la sua email.
     */
    public static function getWaiterByEmail(string $email): ?EWaiter {
        return FEntityManager::getInstance()->retriveObjectOnAttribute(EWaiter::class, 'email', $email);
    }
}