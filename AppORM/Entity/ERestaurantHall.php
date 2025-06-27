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

    #[ORM\Column(type: 'integer', length: 100, nullable: false)]
    private $totalPlaces;

    #[ORM\OneToMany(targetEntity: EWaiter::class, mappedBy: 'restaurant_halls')]
    private Collection $waiters;

    #[ORM\OneToMany(targetEntity: ETable::class, mappedBy: 'restaurant_halls')]
    private Collection $tables;

    #[ORM\OneToMany(targetEntity: EReservation::class, mappedBy: 'restaurantHall')]
    private Collection $reservations;

    #[ORM\OneToMany(targetEntity: ETurn::class, mappedBy: 'restaurantHall')]
    private Collection $turns;

    private static $entity = ERestaurantHall::class;


    //constructor
    public function __construct($tablesNumber) {
        $this->tablesNumber = $tablesNumber;
    }

    public function getIdHall() {
        return $this->idHall;
    }

    public static function getEntity() {
        return self::$entity;
    }

    public function getTablesNumber() {
        return $this->tablesNumber;
    }

    public function setTablesNumber($tablesNumber) {
        $this->tablesNumber = $tablesNumber;
    }
}