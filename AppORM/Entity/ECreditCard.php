<?php
// AppORM/Entity/ECreditCard.php

namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rappresenta un metodo di pagamento tokenizzato, non una carta di credito reale.
 * NON contiene dati sensibili come il numero completo della carta o il CVV.
 */
#[ORM\Entity]
#[ORM\Table(name: 'credit_cards')]
class ECreditCard
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: EClient::class, inversedBy: 'creditCards')]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private EClient $client;

    #[ORM\Column(type: 'string', length: 255)]
    private string $paymentGatewayToken; // Token del gateway (es. "pm_...")

    #[ORM\Column(type: 'string', length: 50)]
    private string $brand; // Es. "Visa", "MasterCard"

    #[ORM\Column(type: 'string', length: 4)]
    private string $last4; // Ultime 4 cifre della carta

    #[ORM\Column(type: 'integer')]
    private int $expMonth; // Mese di scadenza (es. 12)

    #[ORM\Column(type: 'integer')]
    private int $expYear; // Anno di scadenza (es. 2028)

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $cardName; // Nome amichevole (es. "La mia Visa Lavoro")


    /**
     * Costruttore aggiornato per accettare solo dati sicuri e tokenizzati.
     */
    public function __construct(
        EClient $client,
        string $paymentToken,
        string $brand,
        string $last4,
        int $expMonth,
        int $expYear,
        ?string $cardName = null
    ) {
        $this->client = $client;
        $this->paymentGatewayToken = $paymentToken;
        $this->brand = $brand;
        $this->last4 = $last4;
        $this->expMonth = $expMonth;
        $this->expYear = $expYear;
        $this->cardName = $cardName;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): EClient
    {
        return $this->client;
    }

    public function setClient(EClient $client): self
    {
        $this->client = $client;
        return $this;
    }

    public function getPaymentGatewayToken(): string
    {
        return $this->paymentGatewayToken;
    }

    public function setPaymentGatewayToken(string $paymentGatewayToken): self
    {
        $this->paymentGatewayToken = $paymentGatewayToken;
        return $this;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;
        return $this;
    }

    public function getLast4(): string
    {
        return $this->last4;
    }

    public function setLast4(string $last4): self
    {
        $this->last4 = $last4;
        return $this;
    }

    public function getExpMonth(): int
    {
        return $this->expMonth;
    }

    public function setExpMonth(int $expMonth): self
    {
        $this->expMonth = $expMonth;
        return $this;
    }

    public function getExpYear(): int
    {
        return $this->expYear;
    }

    public function setExpYear(int $expYear): self
    {
        $this->expYear = $expYear;
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