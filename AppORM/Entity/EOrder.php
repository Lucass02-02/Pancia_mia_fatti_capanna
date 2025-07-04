<?php

namespace AppORM\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;


enum OrderStatus: string {
    case CREATED = 'created';
    case IN_PROGRESS = 'in_progress';
    case READY = 'ready'; //questi due puoi usarli per delle statistiche che magari può vedere l'admin, ma vanno implementate
    case SERVED = 'served'; //credo vadano cambiate delle foundation per asseganre lo stato ad ogni fase dell'ordine
    case PAID = 'paid';
    case CANCELED = 'canceled';
}


#[ORM\Entity]
#[ORM\Table(name: 'orders')]
class EOrder {

    //attributes

    #[ORM\Id]
    #[ORM\Column(type: 'integer', nullable: false)]
    #[ORM\GeneratedValue]
    private $id;

    #[ORM\Column(type: 'datetime', nullable: false)]
    private $date;

    #[ORM\Column(type: 'string', length: 20, nullable: false, enumType: OrderStatus::class)]
    private OrderStatus $status;

    //cambia il collegamento con client e metti reservation
    #[ORM\ManyToOne(targetEntity: EReservation::class, inversedBy: 'orders', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'reservation_id', referencedColumnName: 'idReservation')]
    private EReservation $reservation;

    #[ORM\OneToMany(targetEntity: EOrderItem::class, mappedBy: 'order', cascade: ['persist'])]
    private Collection $orderItems;

    #[ORM\ManyToMany(targetEntity: EProduct::class, mappedBy: 'orders', cascade: ['persist'])]
    private Collection $products;

    private static $entity = EOrder::class;

    //constructor

    public function __construct($date) {
        $this->date = $date;
        $this->status = OrderStatus::CREATED; 
    }

    //methods getters and setters

    public static function getEntity() {
        return self::$entity;
    }

    public function getIdOrder() {
        return $this->id;
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

    public function getOrderItems(): Collection {
        return $this->orderItems;
    }

    public function setOrderItems(Collection $orderItems) {
        $this->orderItems = $orderItems;
    }

    public function getStatus(): OrderStatus {
        return $this->status;
    }

    public function setStatus(OrderStatus $status) {
        $this->status = $status;
    }

    public function getReservation(): EReservation {
        return $this->reservation;
    }

    public function setReservation(EReservation $reservation) {
        $this->reservation = $reservation;
    }
}