<?php

namespace AppORM\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: 'order_items')]
class EOrderItem {

    #[ORM\Id]
    #[ORM\Column(type: 'integer', nullable: false)]
    #[ORM\GeneratedValue]
    private $orderItemId;

    #[ORM\Column(type: 'integer', nullable: false)]
    private $quantity;

    #[ORM\Column(type: 'float', nullable: false)]
    private $price;

    #[ORM\ManyToOne(targetEntity: EOrder::class, inversedBy: 'orderItems', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'order_id', referencedColumnName: 'id')]
    private EOrder $order;

    #[ORM\ManyToOne(targetEntity: EProduct::class, inversedBy: 'orderItems', cascade: ['persist'])]
    #[ORM\JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    private EProduct $product;

    private static $entity = EOrderItem::class;

    public function __construct(int $quantity) {
        $this->quantity = $quantity;
    }

    public static function getEntity() {
        return self::$entity;
    }

    public function getOrderItemId() {
        return $this->orderItemId;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity(int $quantity) {
        $this->quantity = $quantity;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice(float $price) {
        $this->price = $price;
    }

    public function getOrder(): EOrder {
        return $this->order;
    }

    public function setOrder(EOrder $order) {
        $this->order = $order;
    }

    public function getProduct(): EProduct {
        return $this->product;
    }

    public function setProduct(EProduct $product) {
        $this->product = $product;
    }
}