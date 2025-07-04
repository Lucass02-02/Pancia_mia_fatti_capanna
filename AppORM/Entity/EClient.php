<?php
// AppORM/Entity/EClient.php

namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use DateTime;
use AppORM\Entity\EUserReview;


#[ORM\Entity]
#[ORM\Table(name: 'clients')]
class EClient extends EUser {

    #[ORM\Column(type: 'string', length: 50, nullable: true)]   
    private $nickname;

    #[ORM\Column(type: 'integer', nullable: false)]
    private int $loyaltyPoints;

    #[ORM\OneToMany(targetEntity: EUserReview::class, mappedBy: 'clients')]
    private Collection $reviews;

    #[ORM\Column(type: 'boolean', nullable: false)]
    private bool $receivesNotifications;
    
    #[ORM\OneToMany(targetEntity: EReservation::class, mappedBy: 'clients')]
    private Collection $reservations;

    #[ORM\OneToMany(targetEntity: ECreditCard::class, mappedBy: 'client', cascade: ['persist', 'remove'])]
    private Collection $creditCards;

    private static $entity = EClient::class;


    //constructor
    public function __construct($name, $surname, $birthDate, $email, $password, $phoneNumber,  $nickname ) {
        parent::__construct( $name, $surname, $birthDate, $email, $password, $phoneNumber);
        $this->nickname = $nickname;
        $this->loyaltyPoints = 0; 
        $this->receivesNotifications = false; 
        $this->reviews = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->creditCards = new ArrayCollection();
    }

    
    //methods getters and setters

    public function getEntity() {
        return self::$entity;
    }

    

    // Metodi specifici di EClient (getter e setter)

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(?string $nickname): self
    {
        $this->nickname = $nickname;
        return $this;
    }

    public function getReceivesNotifications(): bool
    {
        return $this->receivesNotifications;
    }

    public function setReceivesNotifications(bool $receivesNotifications): self
    {
        $this->receivesNotifications = $receivesNotifications;
        return $this;
    }

    public function getLoyaltyPoints(): int
    {
        return $this->loyaltyPoints;
    }

    public function setLoyaltyPoints(int $loyaltyPoints): self
    {
        $this->loyaltyPoints = $loyaltyPoints;
        return $this;
    }

    /**
     * @return Collection<int, EUserReview>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(EUserReview $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setUser($this); // Assicura la coerenza bidirezionale
        }
        return $this;
    }

    public function removeReview(EUserReview $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // Se EUserReview::$user è nullable, potresti fare:
            // if ($review->getUser() === $this) {
            //     $review->setUser(null);
            // }
            // Dato che EUserReview::$user non è nullable, non tentare di settarlo a null qui.
            // L'eliminazione dell'entità EUserReview stessa è il modo corretto di rimuovere il legame.
            // Il cascade 'remove' sull'OneToMany del client gestirà l'eliminazione della review.
        }
        return $this;
    }

    /**
     * @return Collection<int, ECreditCard>
     */
    public function getCreditCards(): Collection
    {
        return $this->creditCards;
    }

    public function addCreditCard(ECreditCard $creditCard): self
    {
        if (!$this->creditCards->contains($creditCard)) {
            $this->creditCards->add($creditCard);
            $creditCard->setClient($this); // Assicura la coerenza bidirezionale
        }
        return $this;
    }

    public function removeCreditCard(ECreditCard $creditCard): self
    {
        if ($this->creditCards->removeElement($creditCard)) {
            // Se ECreditCard::$client non è nullable, non possiamo settarlo a null.
            // L'eliminazione dell'entità ECreditCard stessa è il modo corretto di rimuovere il legame.
            // Il cascade 'remove' sull'OneToMany del client gestirà l'eliminazione della credit card.
        }
        return $this;
    }

    public function getReservations () {
        return $this->reservations;
    }

    
}
