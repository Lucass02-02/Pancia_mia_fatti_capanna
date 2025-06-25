<?php

namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppORM\Entity\EUser;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

#[ORM\Entity]
#[ORM\Table(name: 'clients')]
class EClient extends EUser
{
    #[ORM\Column(type: 'json', nullable: false)]
    private array $savedMethods;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $nickname = null;

    #[ORM\OneToMany(targetEntity: ECreditCard::class, mappedBy: 'client', cascade: ['persist', 'remove'])]
    private Collection $creditCards;

    // MODIFICA CRUCIALE QUI: mappedBy deve essere 'user' perché in EUserReview la proprietà è $user
    #[ORM\OneToMany(targetEntity: EUserReview::class, mappedBy: 'user', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $reviews;

    #[ORM\OneToMany(targetEntity: EReservation::class, mappedBy: 'client', cascade: ['persist', 'remove'])]
    private Collection $reservations;

    #[ORM\OneToMany(targetEntity: EOrder::class, mappedBy: 'client', cascade: ['persist', 'remove'])]
    private Collection $orders;

    // Costruttore
    public function __construct(
        string $name,
        string $surname,
        DateTime $birthDate,
        string $email,
        string $password,
        ?string $nickname,
        ?string $phonenumber,
        array $savedMethods = []
    ) {
        parent::__construct($name, $surname, $birthDate, $email, $password, $phonenumber);
        $this->nickname = $nickname;
        $this->savedMethods = $savedMethods;

        $this->creditCards = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    // Getter e Setter per savedMethods (omessi per brevità, sono gli stessi)
    public function getSavedMethods(): array
    {
        return $this->savedMethods;
    }

    public function setSavedMethods(array $savedMethods): self
    {
        $this->savedMethods = $savedMethods;
        return $this;
    }

    // Getter e Setter per nickname (omessi per brevità, sono gli stessi)
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(?string $nickname): self
    {
        $this->nickname = $nickname;
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
            $creditCard->setClient($this);
        }
        return $this;
    }

    public function removeCreditCard(ECreditCard $creditCard): self
    {
        if ($this->creditCards->removeElement($creditCard)) {
            if ($creditCard->getClient() === $this) {
                $creditCard->setClient(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, EUserReview>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function setReviews(Collection $reviews): self
    {
        $this->reviews = $reviews;
        return $this;
    }

    public function addReview(EUserReview $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            // MODIFICA CRUCIALE QUI: Chiamiamo setUser() su EUserReview
            $review->setUser($this);
        }
        return $this;
    }

    public function removeReview(EUserReview $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // MODIFICA CRUCIALE QUI: Chiamiamo getUser() e setUser(null) su EUserReview
            if ($review->getUser() === $this) {
                $review->setUser(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, EReservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function setReservations(Collection $reservations): self
    {
        $this->reservations = $reservations;
        return $this;
    }

    public function addReservation(EReservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations->add($reservation);
            $reservation->setClient($this);
        }
        return $this;
    }

    public function removeReservation(EReservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            if ($reservation->getClient() === $this) {
                $reservation->setClient(null);
            }
        }
        return $this;
    }

    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function setOrders(Collection $orders): self
    {
        $this->orders = $orders;
        return $this;
    }

    public function addOrder(EOrder $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setClient($this);
        }
        return $this;
    }

    public function removeOrder(EOrder $order): self
    {
        if ($this->orders->removeElement($order)) {
            if ($order->getClient() === $this) {
                $order->setClient(null);
            }
        }
        return $this;
    }
}
