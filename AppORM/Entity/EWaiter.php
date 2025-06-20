<?php

namespace AppORM\Entity;
use Doctrine\ORM\Mapping as ORM;
use AppORM\Entity\EUser;


#[ORM\Entity]
#[ORM\Table(name: 'waiters')]
class EWaiter extends EUser {
    
    
    //constructor
    public function __construct($name, $surname, $email, $password) {
        parent::__construct($name, $surname, $email, $password);
    }

    
}