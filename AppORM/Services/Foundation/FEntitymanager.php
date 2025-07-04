<?php
namespace AppORM\Services\Foundation;

require_once(__DIR__ . '/../../../bootstrap.php');


class FEntityManager{
    private static $instance;
    private static $entityManager;


    private function __construct() {
        self::$entityManager = getEntityManager();
    }

    public static function getInstance(){
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function getEntityManager(){
        return self::$entityManager;
    }

     /**
     * retrive one obj
     * @return obj || null
     */
    public static function retriveObject($class, $id){
        try{
            $obj = self::$entityManager->find($class, $id);
            return $obj;
        }catch(\Exception $e){
            echo "ERROR: ". $e->getMessage();
            return null;
        }
    }

    /**
     * return an object finding it not on the id but on an attribute
     */
    public static function retriveObjectOnAttribute($class, $field, $id){
        try{
            $obj = self::$entityManager->getRepository($class)->findOneBy([$field => $id]);
            return $obj;
        }catch(\Exception $e){
            echo "ERROR: ". $e->getMessage();
            return null;
        }
    }

    /**
     * return a list of objects
     * @return array
     */
    public static function retriveObjectList($table, $field, $id)
    {
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." . $field . " = :creatorId";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('creatorId', $id);
            $result = $query->getResult();
            return $result;
            }catch(\Exception $e){
                echo "ERROR " . $e->getMessage();
                return [];
            }
        
    }

    /**
     * return a list of object that are not banned (for ex. posts and comments not banned)
     * @return array
     */
    public static function objectListNotRemoved($table, $field, $id)
    {
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." . $field . " = :creatorId AND e.removed = 0";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('creatorId', $id);
            $result = $query->getResult();
            if(count($result) > 0)
            {
                return $result;
            }else{
                return array();
            }
        }catch(\Exception $e){
            echo "ERROR " . $e->getMessage();
            return array();
        }
    }

    /**
     * return all the object of a specifyc table where the field value is null(ex. all the report)
     * @return array
     */
    public static function objectListUsingNull($table, $field){
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." .$field. " IS NULL";
            $query = self::$entityManager->createQuery($dql);
            $result = $query->getResult();
            if(count($result) > 0){
                return $result;
            }else{
                return array();
            }
        }catch(\Exception $e){
                echo "ERROR " . $e->getMessage();
                return null;
        }
    }

    /**
     * return an object finding it not on the id but specifying 2 attributes
     */
    public static function retriveObjectOnTwoAttributes($table, $field1, $id1, $field2, $id2)
    {
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." . $field1 . " = :id1 AND e." . $field2 . " = :id2";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('id1', $id1);
            $query->setParameter('id2', $id2);
            $result = $query->getOneOrNullResult();
            return $result;

        }catch(\Exception $e){
            self::$entityManager->getConnection();
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

    /**
     * return a list of all the object that have the $str in the specified attribute
     */
    public static function getSearchedItem($table, $field, $str)
    {
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." . $field . " LIKE :searchedStr";
            $query = self::$entityManager->createQuery($dql)->setParameter('searchedStr', '%' . $str . '%');
            $result = $query->getResult();
            if(count($result) > 0)
            {
                return $result;
            }else{
                return array();
            }
        }catch(\Exception $e){
            echo "ERROR " . $e->getMessage();
            return null;
        }
    }

    /**
     * return the number of objects in a list finding they on a specific attribute
     */
    public static function countObjectListAttribute($table, $field, $id)
    {
        try{
            $dql = "SELECT COUNT(e) FROM " . $table . " e WHERE  e." .$field . " = :attribute";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('attribute', $id);

            $result = $query->getSingleScalarResult();
            return $result;
        }catch(\Exception $e){
            echo "ERROR " . $e->getMessage();
            return [];
        }
    }

    /**
     * verify if exist an object
     */
    public static function verifyAttributes($fieldId, $table, $field, $id){
        try{
            $dql = "SELECT u.id".$fieldId. " FROM " . $table . " u WHERE u." . $field . " = :attribute";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('attribute', $id);

            $result = $query->getResult();
            if(count($result) > 0){
                return true;
            }else{
                return false;
            }
        }catch(\Exception $e){
                echo "ERROR " . $e->getMessage();
                return null;
            }
    }

       /**
     * Prepara un oggetto per il salvataggio (persist) e lo scrive nel DB (flush).
     * NON gestisce la transazione.
     * @return boolean
     */
    public static function saveObject($obj): bool
    {
        try {
            self::$entityManager->persist($obj);
            self::$entityManager->flush();
            return true;
        } catch(\Exception $e) {
            // Non stampiamo più l'errore qui, lo lasciamo "salire" al chiamante
            // che è dentro un blocco try/catch più grande.
            // echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

    /**
     * Prepara un oggetto per la cancellazione (remove) e lo rimuove dal DB (flush).
     * NON gestisce la transazione.
     * @return boolean
     */
    public static function deleteObject($obj): bool
    {
        try {
            self::$entityManager->remove($obj);
            self::$entityManager->flush();
            return true;
        } catch(\Exception $e) {
            // echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

    /**
     * return an array of all elemnts of a table
     * @return array
     */
    public static function selectAll($table){
        try{
            $dql = "SELECT e FROM " . $table . " e";
            $query = self::$entityManager->createQuery($dql);
            $result = $query->getResult();
            return $result;
        }catch(\Exception $e){
            echo "ERROR " . $e->getMessage();
            return [];
        }
    }
}