<?php

namespace AppORM\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'restaurant_halls')]
class ERestaurantHall {

    //attributes
    #[ORM\Id]
    #[ORM\Column(type: 'integer', nullable: false)]
    #[ORM\GeneratedValue]
    private $idHall;

    #[ORM\OneToMany(targetEntity: EWaiter::class, mappedBy: 'restaurant_halls')]
    private Collection $waiters;

    #[ORM\OneToMany(targetEntity: ETable::class, mappedBy: 'restaurant_halls')]
    private Collection $tables;


    public function getIdHall() {
        return $this->idHall;
    }

    public function getEntity() {
        return self::class;
    }
}