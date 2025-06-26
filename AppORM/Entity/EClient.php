<?php
// PHP Version: 8.1+

namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppORM\Entity\EUser;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use \DateTime; // Uso \DateTime per la classe globale

#[ORM\Entity]
#[ORM\Table(name: 'clients')]
class EClient extends EUser
{
    // RIMOSSO il campo savedMethods di tipo json (non più qui)

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $nickname = null;

    #[ORM\OneToMany(targetEntity: ECreditCard::class, mappedBy: 'client', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $creditCards; // Questa Collection ora rappresenta i "metodi salvati"

    #[ORM\OneToMany(targetEntity: EUserReview::class, mappedBy: 'user', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $reviews;

    #[ORM\OneToMany(targetEntity: EReservation::class, mappedBy: 'client', cascade: ['persist', 'remove'])]
    private Collection $reservations;

    #[ORM\OneToMany(targetEntity: EOrder::class, mappedBy: 'client', cascade: ['persist', 'remove'])]
    private Collection $orders;

    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $receivesNotifications = false;

    #[ORM\Column(type: 'integer', options: ['default' => 0])]
    private int $loyaltyPoints = 0;

    // Costruttore
    public function __construct(
        string $name,
        string $surname,
        \DateTime $birthDate,
        string $email,
        string $password,
        ?string $nickname = null,
        ?string $phonenumber = null
        // RIMOSSO: `array $savedMethods = []` dal costruttore
    ) {
        parent::__construct($name, $surname, $birthDate, $email, $password, $phonenumber);
        $this->nickname = $nickname;

        $this->creditCards = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    // Getter e Setter per nickname
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
            // RIMOSSO: La riga che impostava il client a null
            // if ($creditCard->getClient() === $this) {
            //     $creditCard->setClient(null);
            // }
            // Con orphanRemoval: true, Doctrine si aspetta di ELIMINARE l'entità orfana.
            // Tentare di impostare la relazione a null quando la FK non è nullable causa l'errore.
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
            $review->setUser($this);
        }
        return $this;
    }

    public function removeReview(EUserReview $review): self
    {
        if ($this->reviews->removeElement($review)) {
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

    // --- METODI EREDITATI DA EUser (CORRETTI PER COMPATIBILITÀ) ---
    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function setName($name) { $this->name = $name; }
    public function getSurname(): string { return $this->surname; }
    public function setSurname($surname) { $this->surname = $surname; }
    public function getBirthDate(): \DateTime { return $this->birthDate; }
    public function setBirthDate($birthDate) { $this->birthDate = $birthDate; }
    public function getEmail(): string { return $this->email; }
    public function setEmail($email) { $this->email = $email; }
    public function getPassword(): string { return $this->password; }
    public function setPassword($password) { $this->password = $password; }
    public function getPhonenumber(): ?string { return $this->phonenumber; }
    public function setPhonenumber($phonenumber) { $this->phonenumber = $phonenumber; }
    // -----------------------------------------------------------------

    // --- GETTER E SETTER PER LE NUOVE PROPRIETÀ ---
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
}
