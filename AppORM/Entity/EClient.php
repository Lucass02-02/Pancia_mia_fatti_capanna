<?php
// AppORM/Entity/EClient.php

namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use DateTime;

#[ORM\Entity]
#[ORM\Table(name: 'clients')]
class EClient extends EUser {

    #[ORM\Column(type: 'string', length: 50, nullable: true)]   
    private ?string $nickname;

    #[ORM\Column(type: 'integer')]
    private int $loyaltyPoints = 0;
    /**
     * @Column(type="string", nullable=true)
     */
    private $rememberToken;
    /**
     * CORREZIONE: 'mappedBy' ora punta a 'client' (singolare).
     * cascade e orphanRemoval sono aggiunti per una gestione corretta delle eliminazioni.
     */
    #[ORM\OneToMany(targetEntity: EUserReview::class, mappedBy: 'client', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $reviews;

    #[ORM\Column(type: 'boolean')]
    private bool $receivesNotifications = false;
    
    #[ORM\OneToMany(targetEntity: EReservation::class, mappedBy: 'client')] // Assumendo che in EReservation ci sia una prop $client
    private Collection $reservations;

    #[ORM\OneToMany(targetEntity: ECreditCard::class, mappedBy: 'client', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $creditCards;


    //constructor
    public function __construct($name, $surname, $birthDate, $email, $password, $phoneNumber,  $nickname ) {
        parent::__construct( $name, $surname, $birthDate, $email, $password, $phoneNumber);
        $this->nickname = $nickname;
        $this->reviews = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->creditCards = new ArrayCollection();
    }
    
    // ... tutti i tuoi metodi getters e setters rimangono invariati ...

    public function getNickname(): ?string { return $this->nickname; }
    public function setNickname(?string $nickname): self { $this->nickname = $nickname; return $this; }
    public function getReceivesNotifications(): bool { return $this->receivesNotifications; }
    public function setReceivesNotifications(bool $receivesNotifications): self { $this->receivesNotifications = $receivesNotifications; return $this; }
    public function getLoyaltyPoints(): int { return $this->loyaltyPoints; }
    public function setLoyaltyPoints(int $loyaltyPoints): self { $this->loyaltyPoints = $loyaltyPoints; return $this; }
    public function getReviews(): Collection { return $this->reviews; }
    public function getCreditCards(): Collection { return $this->creditCards; }
    public function getReservations(): Collection { return $this->reservations; }
    public function getRememberToken(): ?string { return $this->rememberToken; }
    public function setRememberToken(?string $rememberToken): void { $this->rememberToken = $rememberToken; }

}