<?php


namespace AppORM\Services\Foundation;
require_once __DIR__ . '/../../../bootstrap.php';



class FEntityManager{
    private static $instance;
    private static $entityManager;

    private function __construct() {
        self::$entityManager = getEntityManager();
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function getEntityManager() {
        return self::$entityManager;
    }


    // Method to return an object by its id
    public static function retriveObject($class, $id) {
        try {
            $object = self::$entityManager->find($class, $id);
            return $object;
        }
        catch (\Exception $e) {
            print "ERROR: " . $e->getMessage();
            return null;
        }
    }

    // Method to return an object by a specific attribute
    public static function retriveObjectOnAttribute($class, $field, $id) {
        try {
            $object = self::$entityManager->getRepository($class)->findOneBy([$field => $id]);
            return $object;
        }
        catch (\Exception $e) {
            print "ERROR: " . $e->getMessage();
            return null;
        }
    }

    // Method to return a list of objects based on a specific field and value
    public static function retriveObjectList($table, $field, $id) {
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." . $field . " = :creatorId";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('creatorId', $id);
            $results = $query->getResult();
            return $results;
        }
        catch (\Exception $e) {
            print "ERROR: " . $e->getMessage();
            return [];
        }
    }

    // Method to return all the objects of a specific table where the attribute is null
    public static function retriveObjectListFieldNull($table, $field){
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
                print "ERROR " . $e->getMessage();
                return null;
        }
    }

    // Method to return an object based on two attributes
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
            print "ERROR: " . $e->getMessage();
            return false;
        }
    }

    // Method to return a list of object by serching a specific string inside an attribute 
    public static function retriveObjectSearchedItem($table, $field, $str)
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
            print "ERROR " . $e->getMessage();
            return null;
        }
    }


    //Method to return the number of objects in a list finding on a specific attribute
    public static function countObjectListAttribute($table, $field, $id)
    {
        try{
            $dql = "SELECT COUNT(e) FROM " . $table . " e WHERE  e." .$field . " = :attribute";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('attribute', $id);

            $result = $query->getSingleScalarResult();
            return $result;
        }catch(\Exception $e){
            print "ERROR " . $e->getMessage();
            return [];
        }
    }

    // Verify the existence of an object
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

/*------------------------------------OPERATION ON THE DATABASE--------------------------------------------------------------*/

    // Method to save an object in the DB
    public static function saveObject($obj) {
        try{
                self::$entityManager->getConnection()->beginTransaction();
                self::$entityManager->persist($obj);
                self::$entityManager->flush();
                self::$entityManager->getConnection()->commit();
                return true;
        }catch(\Exception $e){
                self::$entityManager->getConnection();
                print "ERROR: " . $e->getMessage();
                return false;
                
            }
    }

    // Method to delete an object from the DB
    public static function deleteObj($obj){
        try{
            self::$entityManager->getConnection()->beginTransaction();
            self::$entityManager->remove($obj);
            self::$entityManager->flush();
            self::$entityManager->getConnection()->commit();
            return true;
        }catch(\Exception $e){
            self::$entityManager->getConnection();
            print "ERROR: " . $e->getMessage();
            return false;
        }
    }

    // Method to select all the elements of a table
    public static function selectAll($table){
        try{
            $dql = "SELECT e FROM " . $table . " e";
            $query = self::$entityManager->createQuery($dql);
            $result = $query->getResult();
            return $result;
        }catch(\Exception $e){
            print "ERROR " . $e->getMessage();
            return [];
        }
    }

}