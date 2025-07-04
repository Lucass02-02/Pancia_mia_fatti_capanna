<?php

namespace AppORM\Services\Foundation;

use AppORM\Entity\EOrder;
use AppORM\Entity\EProduct;
use AppORM\Entity\EOrderItem;

class FOrderItem {

    public static function addItemToOrder(EOrder $order, EProduct $product, int $quantity) {
        
        $orderItem = new EOrderItem($quantity);
        $orderItem->setOrder($order);
        $orderItem->setProduct($product);
        $orderItem->setPrice($product->getCost());

        $orderItems = FEntityManager::getInstance()->selectAll(EOrderItem::getEntity());

        foreach ($orderItems as $item) {
            if ($item->getProduct() === $product) {
               
                $item->setQuantity($item->getQuantity() + $quantity);
                $item = FEntityManager::getInstance()->saveObject($item);
            }
        }

        $orderItem = FEntityManager::getInstance()->saveObject($orderItem);

    }
}
    