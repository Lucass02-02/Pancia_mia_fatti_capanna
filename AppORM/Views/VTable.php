<?php
namespace AppORM\Views;

class VTable
{
    private $smarty;
    public function __construct() { $this->smarty = StartSmarty::configuration(); }

    public function showManagementPage(array $tables, array $halls)
    {
        $this->smarty->assign('tables', $tables);
        $this->smarty->assign('halls', $halls);
        $this->smarty->display('manage_tables.tpl');
    }
}