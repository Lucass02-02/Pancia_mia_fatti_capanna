<?php

namespace AppORM\Entity;
use Doctrine\ORM\Mapping as ORM;
use AppORM\Entity\EUser;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'clients')]
class EClient extends EUser {

    
    #[ORM\Column(type: 'json', length: 50, nullable: false)]
    private array $savedMethods = [];

    #[ORM\Column(type: 'string', length: 50, nullable: false)]   
    private $nickname;

    #[ORM\OneToMany(targetEntity: ECreditCard::class, mappedBy: 'clients', cascade: ['persist', 'remove'])]
    private Collection $creditCards;

    #[ORM\OneToMany(targetEntity: EUserReview::class, mappedBy: 'clients', cascade: ['persist'])]
    private Collection $reviews;
    
    #[ORM\OneToMany(targetEntity: EReservation::class, mappedBy: 'clients', cascade: ['persist'])]
    private Collection $reservations;

    #[ORM\OneToMany(targetEntity: EOrder::class, mappedBy: 'clients', cascade: ['persist'])]
    private Collection $orders;

    private static $entity = EClient::class;


    //constructor
    public function __construct($name, $surname, $birthDate,  $email, $password, $phoneNumber, $savedMethods, $nickname ) {
        parent::__construct( $name, $surname,$birthDate, $email, $password, $phoneNumber);
        $this->savedMethods = [];
        $this->nickname = $nickname;
    }

    
    //methods getters and setters

    public static function getEntity() {
        return self::$entity;
    }

    public function getSavedMethods() {
        return $this->savedMethods;
    }

    public function setSavedMethods(array $savedMethods) {
        $this->savedMethods = $savedMethods;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
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