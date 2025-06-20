<?php

namespace AppORM\Entity;
use Doctrine\ORM\Mapping as ORM;
use AppORM\Entity\EUser;

#[ORM\Entity]
#[ORM\Table(name: 'clients')]
class EClient extends EUser {

    
    #[ORM\Column(type: 'string', length: 50, nullable: false)]
    private array $savedMethods;

    
    //constructor
    public function __construct($name, $surname, $email, $password ) {
        parent::__construct( $nome, $cognome, $email, $password);
        $this->savedMethods = [];
    }

    
    //methods getters and setters

    public function getSavedMethods() {
        return $this->savedMethods;
    }

    public function setSavedMethods(array $savedMethods) {
        $this->savedMethods = $savedMethods;
    }
}