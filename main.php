<?php
require __DIR__."/bootstrap.php";
use AppORM\Services\Utility\UView;


UView::render('cart',
    [
        'title' => 'Carrello',
        'cartItems' => bello,
    ]
);