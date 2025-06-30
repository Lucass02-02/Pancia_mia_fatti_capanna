<?php

namespace AppORM\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

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

    #[ORM\OneToMany(targetEntity: EWaiter::class, mappedBy: 'restaurant_halls', cascade: ['persist'])]
    private Collection $waiters;

    #[ORM\OneToMany(targetEntity: ETable::class, mappedBy: 'restaurant_halls', cascade: ['persist'])]
    private Collection $tables;

    #[ORM\OneToMany(targetEntity: EReservation::class, mappedBy: 'restaurantHall', cascade: ['persist'])]
    private Collection $reservations;

    #[ORM\OneToMany(targetEntity: ETurn::class, mappedBy: 'restaurantHall', cascade: ['persist'])]
    private Collection $turns;

    private static $entity = ERestaurantHall::class;


    //constructor
    public function __construct($totalPlaces) {
        $this->totalPlaces = $totalPlaces;
    }

    public function getIdHall() {
        return $this->idHall;
    }

    public static function getEntity() {
        return self::$entity;
    }

    public function getTotalPlaces() {
        return $this->totalPlaces;
    }

    public function setTotalPlaces($totalPlaces) {
        $this->totalPlaces = $totalPlaces;
    }
}