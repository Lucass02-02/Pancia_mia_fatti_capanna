<?php

require 'bootstrap.php';

use AppORM\Services\Foundation\FOrder;
use AppORM\Services\Foundation\FOrderItem;
use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Foundation\FProduct;


$order = FOrder::getOrderById(1);

$reservation = $order->getReservation();

$product1 = FProduct::getProductById(1);
$product2 = FProduct::getProductById(2);

/*FOrderItem::addItemToOrder($order, $product1, 2);
FOrderItem::addItemToOrder($order, $product2, 3);

$endOrder = FPersistentManager::confirmOrder($order);*/

$viewReview = FPersistentManager::getOrderSummaryForReservation($reservation);