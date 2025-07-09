<?php

namespace AppORM\Entity;
use Doctrine\ORM\Mapping as ORM;
use AppORM\Entity\EUser;


#[ORM\Entity]
#[ORM\Table(name: 'waiters')]
class EWaiter extends EUser {

    #[ORM\Column(type: 'string', length: 50, nullable: false)]
    private string $serialNumber;
    
    #[ORm\ManyToOne(targetEntity: ERestaurantHall::class, inversedBy: 'waiters', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'restaurant_hall_id', referencedColumnName: 'idHall')]
    private ERestaurantHall $restaurant_hall;

    private static $entity = EWaiter::class;


    //constructor
    public function __construct($name, $surname, $email, $password, $serialNumber) {
        parent::__construct($name, $surname, $email, $password);
        $this->serialNumber = $serialNumber;
    }

    public static function getEntity() {
        return self::$entity;
    }

    public function getSerialNumber(): string {
        return $this->serialNumber;
    }

    public function setSerialNumber(string $serialNumber): void {
        $this->serialNumber = $serialNumber;
    }


    public function setRestaurantHall( $restaurant_hall) {
        $this->restaurant_hall = $restaurant_hall;
    }
}