<?php
namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'credit_cards')]

class ECreditCard {

    //attributes

    #[ORM\Id]
    #[ORM\Column(type: 'integer', nullable: false)]
    #[ORM\GeneratedValue]
    private $idCard;

    #[ORM\Column(type: 'string', length: 50, nullable: false)]
    private $nominative;

    #[ORM\Column(type: 'integer', length: 16, nullable: false)]
    private $number;

    #[ORM\Column(type: 'integer', length: 3, nullable: false)]
    private $CVV;

    #[ORM\Column(type: 'date', nullable: false)]
    private $expirationDate;

    #[ORM\Column(type: 'string', length: 50, nullable: false)]
    private $name;

    #[ORM\ManyToOne(targetEntity: EClient::class, inversedBy: 'credit_cards')]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id')]
    private EClient $client;

    //constructor
    public function __construct($nominative, $number, $CVV, $expirationDate, $name) {
        $this->nominative = $nominative;
        $this->number = $number;
        $this->CVV = $CVV;
        $this->expirationDate = $expirationDate;
        $this->name = $name;
    }


    //methods getters and setters

    public function getIdCard() {
        return $this->idCard;
    }
    
    public function getNominative() {
        return $this->nominative;
    }

    public function setNominative($nominative) {
        $this->nominative = $nominative;
    }

    public function getNumber() {
        return $this->number;
    }

    public function setNumber($number) {
        $this->number = $number;
    }

    public function getCVV() {
        return $this->CVV;
    }

    public function setCVV($CVV) {
        $this->CVV = $CVV;
    }

    public function getExpirationDate() {
        return $this->expirationDate;
    }

    public function setExpirationDate($expirationDate) {
        $this->expirationDate = $expirationDate;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

  
    
    
}