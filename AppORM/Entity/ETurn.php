<?php

namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

enum TurnName: string {
    case LUNCH = 'lunch';
    case DINNER = 'dinner';
}

#[ORM\Entity]
#[ORM\Table(name: 'turns')]
class ETurn {
    
    //attributes
    #[ORM\Id]
    #[ORM\Column(type: 'integer', nullable: false)]
    #[ORM\GeneratedValue]
    private $idTurn;

    #[ORM\Column(type: 'string', length: 50, nullable: false, enumType: TurnName::class)]
    private TurnName $name;

    #[ORM\Column(enumType: DayOfWeek::class, nullable: false)]
    private DayOfWeek $dayOfWeek;

    #[ORM\Column(type: 'time', nullable: false)]
    private $startTime;

    #[ORM\Column(type: 'time', nullable: false)]
    private $endTime;

    #[ORM\ManyToOne(targetEntity: ERestaurantHall::class, inversedBy: 'turns', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'restaurant_hall_id', referencedColumnName: 'idHall')]
    private ERestaurantHall $restaurantHall;

    #[ORM\OneToMany(targetEntity: EReservation::class, mappedBy: 'turn', cascade: ['persist'])]
    private Collection $reservations;

    private static $entity = ETurn::class;

    //constructor
    public function __construct(TurnName $name, DayOfWeek $dayOfWeek, $startTime, $endTime) {
        $this->name = $name;
        $this->dayOfWeek = $dayOfWeek;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    //methods getters and setters

    public static function getEntity() {
        return self::$entity;
    }

    public function getIdTurn() {
        return $this->idTurn;
    }

    public function getName(): TurnName {
        return $this->name;
    }

    public function setName(TurnName $name) {
        $this->name = $name;
    }

    public function getDayOfWeek(): DayOfWeek {
        return $this->dayOfWeek;
    }

    public function setDayOfWeek(DayOfWeek $dayOfWeek) {
        $this->dayOfWeek = $dayOfWeek;
    }

    public function getStartTime() {
        return $this->startTime;
    }

    public function setStartTime($startTime) {
        $this->startTime = $startTime;
    }

    public function getEndTime() {
        return $this->endTime;
    }

    public function setEndTime($endTime) {
        $this->endTime = $endTime;
    }

    public function getRestaurantHall(): ERestaurantHall {
        return $this->restaurantHall;
    }

    public function setRestaurantHall(ERestaurantHall $restaurantHall) {
        $this->restaurantHall = $restaurantHall;
    }

}
    