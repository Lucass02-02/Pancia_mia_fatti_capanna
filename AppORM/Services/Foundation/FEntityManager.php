<?php
namespace App\Foundation;
require_once __DIR__ . '/../../../bootstrap.php';

use Exception; // Importa la classe Exception
use Doctrine\ORM\ORMException; // Importa Doctrine\ORM\ORMException per un catch più specifico

class FEntityManager{
    private static $instance;
    private static $entityManager;

    // Il costruttore viene chiamato solo una volta dal getInstance
    private function __construct() {
        self::$entityManager = getEntityManager();
    }

    public static function getInstance() : self { // Aggiunto tipo di ritorno per chiarezza
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Questo metodo ora restituisce l'EntityManager dalla singola istanza.
    public static function getEntityManager() : \Doctrine\ORM\EntityManager { // Aggiunto tipo di ritorno per chiarezza
        // Assicurati che l'istanza sia stata creata prima di accedere a $entityManager
        self::getInstance();
        return self::$entityManager;
    }

    /**
     * Pulisce l'EntityManager, staccando tutti gli oggetti gestiti.
     * Questo forza il ricaricamento degli oggetti dal database
     * nelle successive operazioni di recupero.
     * È essenziale quando si modificano entità e poi le si ricarica per vederne i cambiamenti,
     * soprattutto in script di test.
     */
    public static function clearEntityManager(): void
    {
        // Ottieni l'EntityManager tramite l'istanza prima di chiamare clear()
        self::getEntityManager()->clear();
    }

    // Method to return an object by its id
    public static function retriveObject($class, $id) {
        try {
            return self::getEntityManager()->find($class, $id);
        }
        catch (Exception $e) {
            // DEBUG DETTAGLIATO CON STACK TRACE:
            print "ERROR caught in FEntityManager (" . __FUNCTION__ . "): " . get_class($e) . " - " . $e->getMessage() . "\n";
            print "Stack Trace:\n" . $e->getTraceAsString() . "\n";
            return null;
        }
    }

    // Method to return an object by a specific attribute
    public static function retriveObjectOnAttribute($class, $field, $value) {
        try {
            return self::getEntityManager()->getRepository($class)->findOneBy([$field => $value]);
        }
        catch (Exception $e) {
            // DEBUG DETTAGLIATO
            print "ERROR caught in FEntityManager (" . __FUNCTION__ . "): " . get_class($e) . " - " . $e->getMessage() . "\n";
            print "Stack Trace:\n" . $e->getTraceAsString() . "\n";
            return null;
        }
    }

    // Method to return a list of objects based on a specific field and value
    public static function retriveObjectList($class, $field, $value) {
        try {
            return self::getEntityManager()->getRepository($class)->findBy([$field => $value]);
        }
        catch (Exception $e) {
            // DEBUG DETTAGLIATO
            print "ERROR caught in FEntityManager (" . __FUNCTION__ . "): " . get_class($e) . " - " . $e->getMessage() . "\n";
            print "Stack Trace:\n" . $e->getTraceAsString() . "\n";
            return [];
        }
    }

    // Method to return all the objects of a specific table where the attribute is null
    public static function retriveObjectListFieldNull($table, $field){
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." .$field. " IS NULL";
            $query = self::getEntityManager()->createQuery($dql);
            $result = $query->getResult();
            if(count($result) > 0){
                return $result;
            }else{
                return array();
            }
        }catch(Exception $e){
                // DEBUG DETTAGLIATO
                print "ERROR caught in FEntityManager (" . __FUNCTION__ . "): " . get_class($e) . " - " . $e->getMessage() . "\n";
                print "Stack Trace:\n" . $e->getTraceAsString() . "\n";
                return null;
        }
    }

    // Method to return an object based on two attributes
    public static function retriveObjOnTwoAttributes($table, $field1, $id1, $field2, $id2)
    {
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." . $field1 . " = :id1 AND e." . $field2 . " = :id2";
            $query = self::getEntityManager()->createQuery($dql);
            $query->setParameter('id1', $id1);
            $query->setParameter('id2', $id2);
            $result = $query->getOneOrNullResult();
            return $result;
        }catch(Exception $e){
            // DEBUG DETTAGLIATO
            print "ERROR caught in FEntityManager (" . __FUNCTION__ . "): " . get_class($e) . " - " . $e->getMessage() . "\n";
            print "Stack Trace:\n" . $e->getTraceAsString() . "\n";
            return null;
        }
    }

    // Method to return a list of object by serching a specific string inside an attribute
    public static function retriveObjectSearchedItem($table, $field, $str)
    {
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." . $field . " LIKE :searchedStr";
            $query = self::getEntityManager()->createQuery($dql)->setParameter('searchedStr', '%' . $str . '%');
            $result = $query->getResult();
            if(count($result) > 0)
            {
                return $result;
            }else{
                return array();
            }
        }catch(Exception $e){
            // DEBUG DETTAGLIATO
            print "ERROR caught in FEntityManager (" . __FUNCTION__ . "): " . get_class($e) . " - " . $e->getMessage() . "\n";
            print "Stack Trace:\n" . $e->getTraceAsString() . "\n";
            return null;
        }
    }

    //Method to return the number of objects in a list finding on a specific attribute
    public static function countObjectListAttribute($table, $field, $id)
    {
        try{
            $dql = "SELECT COUNT(e) FROM " . $table . " e WHERE  e." .$field . " = :attribute";
            $query = self::getEntityManager()->createQuery($dql);
            $query->setParameter('attribute', $id);

            $result = $query->getSingleScalarResult();
            return $result;
        }catch(Exception $e){
            // DEBUG DETTAGLIATO
            print "ERROR caught in FEntityManager (" . __FUNCTION__ . "): " . get_class($e) . " - " . $e->getMessage() . "\n";
            print "Stack Trace:\n" . $e->getTraceAsString() . "\n";
            return [];
        }
    }

    // Verify the existence of an object
    public static function verifyAttributes($fieldId, $table, $field, $id){
        try{
            $dql = "SELECT u.id".$fieldId. " FROM " . $table . " u WHERE u." . $field . " = :attribute";
            $query = self::getEntityManager()->createQuery($dql);
            $query->setParameter('attribute', $id);

            $result = $query->getResult();
            if(count($result) > 0){
                return true;
            }else{
                return false;
            }
        }catch(Exception $e){
                // DEBUG DETTAGLIATO
                print "ERROR caught in FEntityManager (" . __FUNCTION__ . "): " . get_class($e) . " - " . $e->getMessage() . "\n";
                print "Stack Trace:\n" . $e->getTraceAsString() . "\n";
                return null;
            }
    }

/*------------------------------------OPERATION ON THE DATABASE--------------------------------------------------------------*/

    // Method to save an object in the DB
    public static function saveObject($obj) {
        try{
            $em = self::getEntityManager();
            // RIMOZIONE DELLA GESTIONE DELLA TRANSAZIONE QUI. La transazione sarà gestita esternamente, se necessaria.
            $em->persist($obj);
            $em->flush(); // Flush immediato, ma senza transazione locale
            return true;
        }catch(Exception $e){
            // Non c'è transazione da fare rollback qui, poiché la gestione è esterna.
            print "ERROR caught in FEntityManager (" . __FUNCTION__ . "): " . get_class($e) . " - " . $e->getMessage() . "\n";
            print "Stack Trace:\n" . $e->getTraceAsString() . "\n";
            return false;
        }
    }

    // Method to delete an object from the DB
    public static function deleteObj($obj){
        try{
            $em = self::getEntityManager();
            // RIMOZIONE DELLA GESTIONE DELLA TRANSAZIONE QUI. La transazione sarà gestita esternamente, se necessaria.
            $em->remove($obj);
            $em->flush(); // Flush immediato, ma senza transazione locale
            return true;
        }catch(Exception $e){
            // Non c'è transazione da fare rollback qui.
            print "ERROR caught in FEntityManager (" . __FUNCTION__ . "): " . get_class($e) . " - " . $e->getMessage() . "\n";
            print "Stack Trace:\n" . $e->getTraceAsString() . "\n";
            return false;
        }
    }

    // Method to select all the elements of a table
    public static function selectAll($table){
        try{
            $dql = "SELECT e FROM " . $table . " e";
            $query = self::getEntityManager()->createQuery($dql);
            $result = $query->getResult();
            return $result;
        }catch(Exception $e){
            // DEBUG DETTAGLIATO CON STACK TRACE
            print "ERROR caught in FEntityManager (" . __FUNCTION__ . "): " . get_class($e) . " - " . $e->getMessage() . "\n";
            print "Stack Trace:\n" . $e->getTraceAsString() . "\n";
            return [];
        }
    }

}
