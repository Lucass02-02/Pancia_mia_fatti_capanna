<?php
// Posizione: AppORM/Services/Foundation/FEntityManager.php

namespace AppORM\Services\Foundation; // MODIFICA: Namespace corretto

use Doctrine\ORM\EntityManager;
use Exception;

class FEntityManager
{
    private static ?EntityManager $entityManager = null;

    private function __construct() {}

    public static function getEntityManager(): EntityManager
    {
        if (self::$entityManager === null) {
            self::$entityManager = getEntityManager();
        }
        return self::$entityManager;
    }

    public static function clearEntityManager(): void
    {
        self::getEntityManager()->clear();
    }

    public static function retriveObject(string $class, $id): ?object
    {
        try {
            return self::getEntityManager()->find($class, $id);
        } catch (Exception $e) {
            error_log("ERRORE in " . __METHOD__ . ": " . $e->getMessage());
            return null;
        }
    }

    public static function retriveObjectOnAttribute(string $class, string $field, $value): ?object
    {
        try {
            return self::getEntityManager()->getRepository($class)->findOneBy([$field => $value]);
        } catch (Exception $e) {
            error_log("ERRORE in " . __METHOD__ . ": " . $e->getMessage());
            return null;
        }
    }
    
    public static function saveObject(object $obj): bool
    {
        try {
            $em = self::getEntityManager();
            $em->persist($obj);
            $em->flush();
            return true;
        } catch (Exception $e) {
            error_log("ERRORE in " . __METHOD__ . ": " . $e->getMessage());
            return false;
        }
    }

    public static function deleteObj(object $obj): bool
    {
        try {
            $em = self::getEntityManager();
            $em->remove($obj);
            $em->flush();
            return true;
        } catch (Exception $e) {
            error_log("ERRORE in " . __METHOD__ . ": " . $e->getMessage());
            return false;
        }
    }
    
    public static function selectAll(string $table): array
    {
        try {
            $dql = "SELECT e FROM " . $table . " e";
            $query = self::getEntityManager()->createQuery($dql);
            return $query->getResult();
        } catch (Exception $e) {
            error_log("ERRORE in " . __METHOD__ . ": " . $e->getMessage());
            return [];
        }
    }

    public static function retriveObjOnTwoAttributes(string $table, string $field1, $id1, string $field2, $id2): ?object
    {
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." . $field1 . " = :id1 AND e." . $field2 . " = :id2";
            $query = self::getEntityManager()->createQuery($dql);
            $query->setParameter('id1', $id1);
            $query->setParameter('id2', $id2);
            return $query->getOneOrNullResult();
        } catch(Exception $e) {
            error_log("ERRORE in " . __METHOD__ . ": " . $e->getMessage());
            return null;
        }
    }
}