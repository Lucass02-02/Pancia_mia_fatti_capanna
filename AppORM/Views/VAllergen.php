<?php
namespace AppORM\Views;

class VAllergen
{
    private $smarty;
    public function __construct() { $this->smarty = StartSmarty::configuration(); }

    public function showManagementPage(array $allergens)
    {
        $this->smarty->assign('allergens', $allergens);
        $this->smarty->display('manage_allergens.tpl');
    }
}