<?php

namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppORM\Entity\EUser;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime; // Assicurati che DateTime sia usato se è richiesto nei parametri o return types

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

    // MODIFICA QUI: Aggiunto cascade: ['remove'] e orphanRemoval=true
    #[ORM\OneToMany(targetEntity: EUserReview::class, mappedBy: 'user', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $reviews;

    #[ORM\OneToMany(targetEntity: EReservation::class, mappedBy: 'client', cascade: ['persist', 'remove'])]
    private Collection $reservations;

    #[ORM\OneToMany(targetEntity: EOrder::class, mappedBy: 'client', cascade: ['persist', 'remove'])]
    private Collection $orders;

    // >>> AGGIUNGI QUESTE NUOVE PROPRIETÀ QUI SOTTO: <<<
    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $receivesNotifications = false;

    #[ORM\Column(type: 'integer', options: ['default' => 0])]
    private int $loyaltyPoints = 0;
    // <<< FINE NUOVE PROPRIETÀ

    // Costruttore
    public function __construct(
        string $name,
        string $surname,
        DateTime $birthDate,
        string $email,
        string $password,
        ?string $nickname = null, // Reso opzionale con un valore predefinito
        ?string $phonenumber = null, // Reso opzionale con un valore predefinito
        array $savedMethods = [] // Aggiunto come parametro opzionale con valore predefinito
    ) {
        parent::__construct($name, $surname, $birthDate, $email, $password, $phonenumber);
        $this->nickname = $nickname;
        $this->savedMethods = $savedMethods; // Inizializza savedMethods
        $this->creditCards = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->reservations = new ArrayCollection();
        $this->orders = new ArrayCollection();
        // Le nuove proprietà (receivesNotifications, loyaltyPoints) vengono inizializzate qui dai loro default Doctrine,
        // non è necessario passarle al costruttore a meno che tu non voglia inizializzarle con valori specifici.
    }

    // Metodi getters e setters esistenti (compresi quelli ereditati da EUser)
    // Non li ho estesi completamente qui per non rendere il blocco codice troppo lungo,
    // ma si presuppone che tu abbia tutti quelli necessari nel tuo file.
    // Includo solo un esempio per mostrare il punto dove aggiungere i nuovi.

    public function getSavedMethods(): array
    {
        return $this->savedMethods;
    }

    public function setSavedMethods(array $savedMethods): self
    {
        $this->savedMethods = $savedMethods;
        return $this;
    }

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
            // set the owning side to null (unless already changed)
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
            // set the owning side to null (unless already changed)
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

    /**
     * @return Collection<int, EOrder>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
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

    // Metodi ereditati da EUser (getters e setters per id, name, surname, birthDate, email, password, phonenumber)
    // Se non li hai già nel tuo file, dovresti includerli.
    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }
    public function getSurname(): string { return $this->surname; }
    public function setSurname(string $surname): self { $this->surname = $surname; return $this; }
    public function getBirthDate(): DateTime { return $this->birthDate; }
    public function setBirthDate(DateTime $birthDate): self { $this->birthDate = $birthDate; return $this; }
    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): self { $this->email = $email; return $this; }
    public function getPassword(): string { return $this->password; }
    public function setPassword(string $password): self { $this->password = $password; return $this; }
    public function getPhonenumber(): ?string { return $this->phonenumber; }
    public function setPhonenumber(?string $phonenumber): self { $this->phonenumber = $phonenumber; return $this; }

    // >>> AGGIUNGI QUESTI NUOVI GETTER E SETTER QUI SOTTO: <<<
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
    // <<< FINE NUOVI GETTER E SETTER
}
