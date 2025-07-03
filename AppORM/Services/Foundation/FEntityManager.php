<?php
namespace AppORM\Services\Foundation;

use Doctrine\ORM\EntityManager;
use Exception;

class FEntityManager
{
    // ... tutti gli altri metodi rimangono uguali ...

    /**
     * Salva un oggetto (Entity) nel database.
     * MODIFICATO: Ora lancia un'eccezione in caso di errore.
     * @param object $entity L'entità da salvare.
     * @return bool True se il salvataggio ha avuto successo.
     * @throws Exception se si verifica un errore durante il salvataggio.
     */
    public static function saveObject(object $entity): bool
    {
        $em = self::getEntityManager();
        $em->beginTransaction();
        try {
            $em->persist($entity);
            $em->flush();
            $em->commit();
            return true;
        } catch (Exception $e) {
            $em->rollback();
            // Oltre a loggarlo, ora "lanciamo" l'errore verso l'alto,
            // così lo script che ha chiamato questo metodo può vederlo.
            error_log("Errore durante il salvataggio dell'oggetto: " . $e->getMessage());
            throw $e; // <-- RIGA AGGIUNTA
        }
    }

    // ... tutti gli altri metodi rimangono uguali ...
    private static ?EntityManager $instance = null;
    public static function setEntityManager(EntityManager $entityManager): void { self::$instance = $entityManager; }
    public static function getEntityManager(): EntityManager { if (self::$instance === null) { throw new Exception("L'EntityManager non è stato configurato."); } return self::$instance; }
    public static function retriveObject(string $class, int $id): ?object { return self::getEntityManager()->find($class, $id); }
    public static function retriveObjectOnAttribute(string $class, string $attribute, mixed $value): ?object { return self::getEntityManager()->getRepository($class)->findOneBy([$attribute => $value]); }
    public static function removeObject(object $entity): bool { $em = self::getEntityManager(); $em->beginTransaction(); try { $em->remove($entity); $em->flush(); $em->commit(); return true; } catch (Exception $e) { $em->rollback(); error_log("Errore: " . $e->getMessage()); throw $e; } }
    public static function retrieveAll(string $class): array { return self::getEntityManager()->getRepository($class)->findAll(); }
}
