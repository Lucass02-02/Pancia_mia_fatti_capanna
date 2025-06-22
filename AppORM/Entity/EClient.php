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

    private static $entity = EClient::class;


    //constructor
    public function __construct($name, $surname, $email, $password ) {
        parent::__construct( $nome, $cognome, $email, $password);
        $this->savedMethods = [];
    }

    
    //methods getters and setters

    public function getEntity() {
        return self::$entity;
    }

    public function getSavedMethods() {
        return $this->savedMethods;
    }

    public function setSavedMethods(array $savedMethods) {
        $this->savedMethods = $savedMethods;
    }

    public function getCreditCards(): Collection {
        return $this->creditCards;
    }

    public function setCreditCards(Collection $creditCards) {
        $this->creditCards = $creditCards;
    }

    public function getReviews(): Collection {
        return $this->reviews;
    }

    public function setReviews(Collection $reviews) {
        $this->reviews = $reviews;
    }

    public function getReservations(): Collection {
        return $this->reservations;
    }

    public function setReservations(Collection $reservations) {
        $this->reservations = $reservations;
    }

    public function getOrders(): Collection {
        return $this->orders;
    }

    public function setOrders(Collection $orders) {
        $this->orders = $orders;
    }


}