<?php
// File: AppORM/Entity/ERestaurantHall.php (AGGIORNATO)
// File: AppORM/Entity/ERestaurantHall.php (AGGIORNATO)
namespace AppORM\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
#[ORM\Table(name: 'restaurant_halls')]
class ERestaurantHall {

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $idHall = null;
    private ?int $idHall = null;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $name;

    #[ORM\Column(type: 'integer')]
    private int $totalPlaces;

    #[ORM\OneToMany(targetEntity: ETable::class, mappedBy: 'restaurantHall')]
    private Collection $tables;

    #[ORM\OneToMany(targetEntity: EWaiter::class, mappedBy: 'restaurant_halls', cascade: ['persist'])]
    private Collection $waiters;

    #[ORM\OneToMany(targetEntity: EReservation::class, mappedBy: 'restaurantHall', cascade: ['persist'])]
    private Collection $reservations;

    #[ORM\OneToMany(targetEntity: ETurn::class, mappedBy: 'restaurantHall', cascade: ['persist'])]
    private Collection $turns;
    


    public function __construct(string $name, int $totalPlaces) {
        $this->name = $name;
        $this->totalPlaces = $totalPlaces;
        $this->tables = new ArrayCollection();
    }

    public static function getEntity() {
        return self::class;
    }

    
    public function getIdHall(): ?int {
        return $this->idHall;
    }

    
    public function getName(): string {
        return $this->name;
    }

    
    public function getTotalPlaces(): int {
        return $this->totalPlaces;
    }

    
    public function setTotalPlaces(int $totalPlaces): void {
        $this->totalPlaces = $totalPlaces;
    }

    
    /**
     * Restituisce la collezione di tavoli presenti in questa sala.
     * @return Collection
     */
    public function getTables(): Collection
    {
        return $this->tables;
    }
}