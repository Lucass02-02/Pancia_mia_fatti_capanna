<?php
// AppORM/Entity/ECreditCard.php

namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Entity]
#[ORM\Table(name: 'credit_cards')]
class ECreditCard
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\ManyToOne(targetEntity: EClient::class, inversedBy: 'creditCards')]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id', nullable: false)]
    private EClient $client;

    #[ORM\Column(type: 'string', length: 100)]
    private string $cardHolderName;

    #[ORM\Column(type: 'string', length: 20)] // Per numero di carta (mascherato o hashed in prod)
    private string $cardNumber;

    #[ORM\Column(type: 'string', length: 4)] // Per CVV (mascherato o hashed in prod)
    private string $cvv;

    #[ORM\Column(type: 'date')]
    private DateTime $expirationDate;

    #[ORM\Column(type: 'string', length: 50, nullable: true)] // Il nome amichevole della carta
    private ?string $cardName;

    public function __construct(
        EClient $client,
        string $cardHolderName,
        string $cardNumber,
        string $cvv,
        DateTime $expirationDate,
        ?string $cardName = null // Ora accetta il nome della carta, opzionale
    ) {
        $this->client = $client;
        $this->cardHolderName = $cardHolderName;
        $this->cardNumber = $cardNumber;
        $this->cvv = $cvv;
        $this->expirationDate = $expirationDate;
        $this->cardName = $cardName; // Assegna il nome della carta
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): EClient
    {
        return $this->client;
    }

    // *** CORREZIONE CRUCIALE QUI: Aggiunto '?' per rendere il parametro nullable ***
    // E aggiunto '= null' come valore di default (anche se non strettamente necessario con '?', è buona pratica)
    public function setClient(?EClient $client = null): self
    {
        $this->client = $client;
        return $this;
    }

    public function getCardHolderName(): string
    {
        return $this->cardHolderName;
    }

    public function setCardHolderName(string $cardHolderName): self
    {
        $this->cardHolderName = $cardHolderName;
        return $this;
    }

    public function getCardNumber(): string
    {
        return $this->cardNumber;
    }

    public function setCardNumber(string $cardNumber): self
    {
        $this->cardNumber = $cardNumber;
        return $this;
    }

    public function getCvv(): string
    {
        return $this->cvv;
    }

    public function setCvv(string $cvv): self
    {
        $this->cvv = $cvv;
        return $this;
    }

    public function getExpirationDate(): DateTime
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(DateTime $expirationDate): self
    {
        $this->expirationDate = $expirationDate;
        return $this;
    }

    public function getCardName(): ?string
    {
        return $this->cardName;
    }

    public function setCardName(?string $cardName): self
    {
        $this->cardName = $cardName;
        return $this;
    }
}
