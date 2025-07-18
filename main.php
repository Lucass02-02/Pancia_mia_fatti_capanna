<?php
require __DIR__."/bootstrap.php";
use AppORM\Services\Utility\UView;


UView::render('menu', [
    'title' => 'Menu',
    'items' => [
        ['name' => 'Home', 'url' => '/home'],
        ['name' => 'About', 'url' => '/about'],
        ['name' => 'Contact', 'url' => '/contact'],
    ]
]);
