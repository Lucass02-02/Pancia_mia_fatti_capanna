<?php
// File: AppORM/Entity/EWaiter.php (AGGIORNATO)
namespace AppORM\Entity;
use Doctrine\ORM\Mapping as ORM;
use AppORM\Entity\EUser;

#[ORM\Entity]
#[ORM\Table(name: 'waiters')]
class EWaiter extends EUser {

    #[ORM\Column(type: 'string', length: 50, unique: true, nullable: false)]
    private string $serialNumber;
    
    #[ORM\ManyToOne(targetEntity: ERestaurantHall::class, inversedBy: 'waiters')]
    #[ORM\JoinColumn(name: 'restaurant_hall_id', referencedColumnName: 'idHall')]
    private ERestaurantHall $restaurant_hall;

    private static $entity = EWaiter::class;

    //constructor
    public function __construct($name, $surname, $birthDate, $email, $password, $phoneNumber, $serialNumber) {
        parent::__construct($name, $surname, $birthDate, $email, $password, $phoneNumber);
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

    public function getRestaurantHall(): ERestaurantHall {
        return $this->restaurant_hall;
    }

    public function setRestaurantHall(ERestaurantHall $hall): void {
        $this->restaurant_hall = $hall;
    }
}