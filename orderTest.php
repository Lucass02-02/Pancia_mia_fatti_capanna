<?php

require 'bootstrap.php';

use AppORM\Services\Foundation\FOrder;
use AppORM\Services\Foundation\FPersistentManager;
use AppORM\Services\Foundation\FProduct;

$order = FOrder::getOrderById(1);

$product1 = FProduct::getProductById(1);
$product2 = FProduct::getProductById(2);

$unlockOrder = FPersistentManager::unlockOrder($order);