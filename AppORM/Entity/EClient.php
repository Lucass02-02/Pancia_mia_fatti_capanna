<?php

namespace AppORM\Entity;
use Doctrine\ORM\Mapping as ORM;
use AppORM\Entity\EUser;

#[ORM\Entity]
#[ORM\Table(name: 'clients')]
class EClient extends EUser {

    
    #[ORM\Column(type: 'string', length: 50, nullable: false)]
    private array $savedMethods;

    #[ORM\OneToMany(targetEntity: ECreditCard::class, mappedBy: 'clients', cascade: ['persist', 'remove'])]
    private Collection $creditCards;

    #[ORM\OneToMany(targetEntity: EUserReview::class, mappedBy: 'clients')]
    private Collection $reviews;
    
    #[ORM\OneToMany(targetEntity: EReservation::class, mappedBy: 'clients')]
    private Collection $reservations;

    #[ORM\OneToMany(targetEntity: EOrder::class, mappedBy: 'clients')]
    private Collection $orders;

    //constructor
    public function __construct($name, $surname, $email, $password ) {
        parent::__construct( $nome, $cognome, $email, $password);
        $this->savedMethods = [];
    }

    
    //methods getters and setters

    public function getSavedMethods() {
        return $this->savedMethods;
    }

    public function setSavedMethods(array $savedMethods) {
        $this->savedMethods = $savedMethods;
    }
}