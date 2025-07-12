<?php

namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

enum TurnName: string {
    case LUNCH = 'lunch';
    case DINNER = 'dinner';
}

/*
enum DayOfWeek: int {
    case MONDAY = 0;
    case TUESDAY = 1;
    case WEDNESDAY = 2;
    case THURSDAY = 3;
    case FRIDAY = 4;
    case SATURDAY = 5;
    case SUNDAY = 6;

    
    public static function fromDate(\DateTimeInterface $date): self {
        $w = (int) $date->format('w'); 
        return match ($w) {
        //return match ((int) $date->format('W')) {
            
            0 => self::MONDAY,
            1 => self::TUESDAY,
            2 => self::WEDNESDAY,
            3 => self::THURSDAY,
            4 => self::FRIDAY,
            5 => self::SATURDAY,
            6 => self::SUNDAY,
            default => throw new \InvalidArgumentException("Invalid day of the week"),
        };
    }
}
*/
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

    public function getNameValue(): string {
        return $this->name->value;
    }

    public function setName(TurnName $name) {
        $this->name = $name;
    }

    public function getDayOfWeek(): DayOfWeek {
        return $this->dayOfWeek;
    }

    
    public function getDayOfWeekName(): string {
        return $this->dayOfWeek->name;
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
    