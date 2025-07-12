<?php
namespace AppORM\Views;

class VRestaurantHall
{
    private $smarty;
    public function __construct() { $this->smarty = StartSmarty::configuration(); }

    public function showManagementPage(array $halls)
    {
        $this->smarty->assign('halls', $halls);
        $this->smarty->display('manage_halls.tpl');
    }
}