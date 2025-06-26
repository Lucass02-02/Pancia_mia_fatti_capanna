<?php
// PHP Version: 8.1+

namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'credit_cards')]
class ECreditCard {

    // Attributi
    #[ORM\Id]
    #[ORM\Column(type: 'integer', nullable: false)]
    #[ORM\GeneratedValue]
    private ?int $idCard = null; // Reso nullable per i nuovi oggetti prima del persist

    #[ORM\Column(type: 'string', length: 50, nullable: false)]
    private string $nominative;

    #[ORM\Column(type: 'string', length: 16, nullable: false)] // Cambiato a string per numeri di carta lunghi e non numerici
    private string $number;

    #[ORM\Column(type: 'string', length: 3, nullable: false)] // Cambiato a string per CVV che possono iniziare con 0
    private string $CVV;

    #[ORM\Column(type: 'date', nullable: false)]
    private \DateTime $expirationDate; // Uso \DateTime per la classe globale

    #[ORM\Column(type: 'string', length: 50, nullable: false)]
    private string $name; // Nome amichevole per la carta (es. "Mia Visa")

    #[ORM\ManyToOne(targetEntity: EClient::class, inversedBy: 'creditCards')] // 'creditCards' è la proprietà in EClient
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')] // AGGIUNTO: onDelete: 'CASCADE'
    private EClient $client;

    // Costruttore
    // Aggiunto EClient $client al costruttore
    public function __construct(EClient $client, string $nominative, string $number, string $CVV, \DateTime $expirationDate, string $name) {
        $this->client = $client;
        $this->nominative = $nominative;
        $this->number = $number;
        $this->CVV = $CVV;
        $this->expirationDate = $expirationDate;
        $this->name = $name;
    }

    // Metodi getters e setters

    public function getEntity(): string {
        return self::class;
    }

    public function getIdCard(): ?int {
        return $this->idCard;
    }

    public function getNominative(): string {
        return $this->nominative;
    }

    public function setNominative(string $nominative): self {
        $this->nominative = $nominative;
        return $this;
    }

    public function getNumber(): string {
        return $this->number;
    }

    public function setNumber(string $number): self {
        $this->number = $number;
        return $this;
    }

    public function getCVV(): string {
        return $this->CVV;
    }

    public function setCVV(string $CVV): self {
        $this->CVV = $CVV;
        return $this;
    }

    public function getExpirationDate(): \DateTime {
        return $this->expirationDate;
    }

    public function setExpirationDate(\DateTime $expirationDate): self {
        $this->expirationDate = $expirationDate;
        return $this;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;
        return $this;
    }

    public function getClient(): EClient {
        return $this->client;
    }

    public function setClient(EClient $client): self {
        $this->client = $client;
        return $this;
    }
}
