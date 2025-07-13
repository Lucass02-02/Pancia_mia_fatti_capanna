<?php
namespace AppORM\Views;
class VCart {
    private $smarty;
    public function __construct() { $this->smarty = StartSmarty::configuration(); }

    public function showCart(array $cartItems) {
        $this->smarty->assign('cartItems', $cartItems);
        $this->smarty->display('cart.tpl');
    }
}