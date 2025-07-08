<?php
namespace AppORM\Views;
use AppORM\Services\Utility\USession; // <-- Aggiunta la 'use' mancante
class VHome {
    private $smarty;
    public function __construct() { $this->smarty = StartSmarty::configuration(); }
    public function showHome(?string $userRole = null) {
        $this->smarty->assign('user_role', $userRole);
        $this->smarty->display('home.tpl');
    }
    public function showMenu(array $products, array $allergens, ?string $userRole, array $selectedAllergens) {
        $this->smarty->assign('products', $products);
        $this->smarty->assign('allAllergens', $allergens);
        $this->smarty->assign('selectedAllergens', $selectedAllergens);
        $this->smarty->assign('isAdmin', $userRole === 'admin');
        $this->smarty->assign('isLoggedIn', USession::isSet('user_id')); // <-- Ora funziona
        $this->smarty->display('menu.tpl');
    }
}