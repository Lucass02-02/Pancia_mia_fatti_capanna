<?php
namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
class EWaiter extends EUser {
    
    //attributes
    protected $idWaiter;


    //constructor
    public function __construct($name, $surname, $email, $password, $idWaiter) {
        parent::__construct($name, $surname, $email, $password);
        $this->idWaiter = $idWaiter;
    }

    //methods getters and setters
    public function getIdWaiter() {
        return $this->idWaiter;
    }

    public function setWaiter($idWaiter) {
        $this->idWaiter = $idWaiter;
    }
}