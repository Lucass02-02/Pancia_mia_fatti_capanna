<?php

namespace AppORM\Entity;
use Doctrine\ORM\Mapping as ORM;
use AppORM\Entity\EUser;


#[ORM\Entity]
#[ORM\Table(name: 'waiters')]
class EWaiter extends EUser {
    
    #[ORm\ManyToOne(targetEntity: ERestaurantHall::class, inversedBy: 'waiters')]
    #[ORM\JoinColumn(name: 'restaurant_hall_id', referencedColumnName: 'idHall')]
    private ERestaurantHall $restaurant_hall;


    //constructor
    public function __construct($name, $surname, $email, $password) {
        parent::__construct($name, $surname, $email, $password);
    }

    
}