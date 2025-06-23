<?php

namespace AppORM\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'orders')]
class EOrder {

    //attributes

    #[ORM\Id]
    #[ORM\Column(type: 'integer', nullable: false)]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(type: 'text', nullable: false)]
    private $note;

    #[ORM\Column(type: 'float', nullable: false)]
    private float $cost;

    #[ORM\Column(type: 'date', nullable: false)]
    private $date;

    #[ORM\ManyToOne(targetEntity: EClient::class, inversedBy: 'orders')]
    #[ORM\JoinColumn(name: 'client_id', referencedColumnName: 'id')]
    private EClient $client;

    #[ORM\ManyToMany(targetEntity: EProduct::class, mappedBy: 'orders')]
    private Collection $products;

    //constructor

    public function __construct($note, float $cost, $date) {
        $this->note = $note;
        $this->cost = $cost;
        $this->date = $date;
    }

    //methods getters and setters

    public function getEntity() {
        return self::class;
    }

    public function getIdOrder() {
        return $this->id;
    }

    public function getNote() {
        return $this->note;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    public function getCost() {
        return $this->cost;
    }

    public function setCost(float $cost) {
        $this->cost = $cost;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function getProducts(): Collection {
        return $this->products;
    }

    public function setProducts(Collection $products) {
        $this->products = $products;
    }
}