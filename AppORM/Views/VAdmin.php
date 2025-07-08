<?php
namespace AppORM\Views;
use AppORM\Entity\EAdmin;
class VAdmin {
    private $smarty;
    public function __construct() { $this->smarty = StartSmarty::configuration(); }

    public function showProfile(EAdmin $admin) {
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('admin_profile.tpl');
    }

    public function showClientsList(array $clients) {
        $this->smarty->assign('clients', $clients);
        $this->smarty->display('manage_clients.tpl');
    }
}